<?php

namespace App\Http\Controllers;

use App\Models\University;

class UniversityController extends Controller
{
    public function index()
    {
        $universities = University::orderBy('name')->paginate(12);

        return view('universities.index', compact('universities'));
    }

    public function show(University $university)
    {
        return view('universities.show', compact('university'));
    }
}
