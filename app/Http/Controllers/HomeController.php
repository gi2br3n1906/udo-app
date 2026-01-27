<?php

namespace App\Http\Controllers;

use App\Models\Rundown;
use App\Models\Sponsor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Fetch Sponsors
        $platinumSponsors = Sponsor::where('type', 'Platinum')->get();
        $goldSponsors = Sponsor::where('type', 'Gold')->get();

        // 2. Dummy Highlights (Mock Data for now)
        // In real app, this might come from a 'Highlights' model or specific Rundown items marked as 'highlight'
        $highlights = collect([
            [
                'type' => 'event',
                'title' => 'Opening Ceremony',
                'subtitle' => 'Main Hall • 08:00',
                'bg_gradient' => 'from-violet-600 to-indigo-600',
                'icon' => 'microphone',
                'tag' => 'Live Now'
            ],
            [
                'type' => 'event',
                'title' => 'Guest Star Performance',
                'subtitle' => 'Main Stage • 13:00',
                'bg_gradient' => 'from-fuchsia-600 to-pink-600',
                'icon' => 'star',
                'tag' => 'Coming Soon'
            ],
            [
                'type' => 'info',
                'title' => 'Doorprize Utama',
                'subtitle' => 'Diundi jam 15:00',
                'bg_gradient' => 'from-emerald-500 to-teal-500',
                'icon' => 'gift',
                'tag' => 'Don\'t Miss'
            ]
        ]);

        // Merge Platinum Sponsors into Highlights for the Carousel
        // We map sponsors to match the highlight structure
        $sponsorHighlights = $platinumSponsors->map(function ($sponsor) {
            return [
                'type' => 'sponsor',
                'title' => $sponsor->name,
                'subtitle' => 'Official Platinum Partner',
                'bg_gradient' => 'from-slate-800 to-slate-900',
                'image' => $sponsor->logo_url,
                'tag' => 'Featured'
            ];
        });

        // Combine logic: Highlights first, then Sponsors, or mix them. 
        // For now, let's put events first, then sponsors.
        $carouselItems = $highlights->merge($sponsorHighlights);

        return view('home', compact('carouselItems', 'goldSponsors'));
    }
}
