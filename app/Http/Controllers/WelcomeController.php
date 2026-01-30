<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'school_origin' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:10,15',
            'dream_major' => 'nullable|string|max:255',
        ]);

        $visitor = Visitor::create([
            'name' => $validated['name'],
            'school_origin' => $validated['school_origin'],
            'phone' => $validated['phone'],
            'dream_major' => $validated['dream_major'] ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'visited_at' => now(),
        ]);

        // Create cookie valid for 30 days (43200 minutes)
        $cookie = Cookie::make('visitor_registered', $visitor->id, 43200);
        $nameCookie = Cookie::make('visitor_name', $validated['name'], 43200);

        return redirect()->route('home')->withCookie($cookie)->withCookie($nameCookie);
    }
}
