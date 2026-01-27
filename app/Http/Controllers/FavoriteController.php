<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\Visitor;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function toggle(Request $request, $id)
    {
        // Get the current visitor from secure cookie 'visitor_registered'
        $visitorId = $request->cookie('visitor_registered');
        
        if (!$visitorId) {
            return response()->json([
                'success' => false,
                'message' => 'Not registered'
            ], 401);
        }

        $visitor = Visitor::find($visitorId);
        
        if (!$visitor) {
            return response()->json([
                'success' => false,
                'message' => 'Visitor not found'
            ], 404);
        }
        
        $university = University::findOrFail($id);

        // Toggle the relationship
        $result = $visitor->favoriteUniversities()->toggle($university->id);

        $status = count($result['attached']) > 0 ? 'attached' : 'detached';

        return response()->json([
            'success' => true,
            'status' => $status
        ]);
    }
}
