<?php

namespace App\Http\Controllers;

use App\Models\Umkm;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::orderBy('name')->paginate(12);

        return view('umkm.index', compact('umkms'));
    }

    public function show(Umkm $umkm)
    {
        return view('umkm.show', compact('umkm'));
    }
}
