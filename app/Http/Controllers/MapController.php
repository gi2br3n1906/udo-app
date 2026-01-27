<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\University;

class MapController extends Controller
{
    public function index()
    {
        // Fetch Universities with booth IDs
        $universities = \App\Models\University::whereNotNull('map_booth_id')
            ->select('id', 'name', 'slug', 'map_booth_id', 'logo_path')
            ->get()
            ->map(function ($uni) {
                return [
                    'id' => $uni->id,
                    'type' => 'university',
                    'name' => $uni->name,
                    'slug' => $uni->slug,
                    'booth_id' => $uni->map_booth_id,
                    'logo_url' => $uni->logo_url,
                    'url' => route('universities.show', $uni->slug)
                ];
            });

        // Fetch UMKMs with booth IDs
        $umkms = \App\Models\Umkm::whereNotNull('map_booth_id')
             ->select('id', 'name', 'map_booth_id')
             ->get()
             ->map(function ($umkm) {
                return [
                    'id' => $umkm->id,
                    'type' => 'umkm',
                    'name' => $umkm->name,
                    'slug' => null,
                    'booth_id' => $umkm->map_booth_id,
                    'logo_url' => null, 
                    'url' => route('umkm.index') 
                ];
            });

        $booths = $universities->merge($umkms);

        return view('map.index', compact('booths'));
    }

    public function getBoothInfo($id)
    {
        // Check if booth belongs to university or UMKM
        $university = University::where('map_booth_id', $id)->first();
        if ($university) {
            return response()->json([
                'type' => 'university',
                'data' => $university
            ]);
        }

        $umkm = Umkm::where('map_booth_id', $id)->first();
        if ($umkm) {
            return response()->json([
                'type' => 'umkm',
                'data' => $umkm
            ]);
        }

        return response()->json([
            'type' => null,
            'message' => 'Booth not found'
        ], 404);
    }
}
