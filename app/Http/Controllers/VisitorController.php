<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function create()
    {
        return view('visitor.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school_origin' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'dream_major' => 'nullable|string|max:255',
        ]);

        Visitor::create([
            'name' => $validated['name'],
            'school_origin' => $validated['school_origin'],
            'phone' => $validated['phone'],
            'dream_major' => $validated['dream_major'] ?? null,
            'visited_at' => now(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('visitor.thank-you');
    }

    public function thankYou()
    {
        return view('visitor.thank-you');
    }
}
