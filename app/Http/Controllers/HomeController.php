<?php

namespace App\Http\Controllers;

use App\Models\Rundown;
use App\Models\Sponsor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Fetch Sponsors
        $platinumSponsors = Sponsor::where('type', 'Platinum')->get();
        $goldSponsors = Sponsor::where('type', 'Gold')->get();

        // 2. Get Current Live or Upcoming Event from Rundowns
        $now = Carbon::now();
        
        // Try to find a LIVE event (start_time <= now AND end_time >= now)
        $currentEvent = Rundown::where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->orderBy('start_time', 'asc')
            ->first();
        
        // If no live event, find the NEXT upcoming event
        $nextEvent = null;
        if (!$currentEvent) {
            $nextEvent = Rundown::where('start_time', '>', $now)
                ->orderBy('start_time', 'asc')
                ->first();
        }

        // 3. Build Dynamic Highlights (NO DOORPRIZE)
        $highlights = collect();
        
        if ($currentEvent) {
            // CASE A: Ada acara LIVE
            $highlights->push([
                'type' => 'event',
                'title' => $currentEvent->title,
                'subtitle' => 'Main Hall • ' . $currentEvent->start_time->format('H:i'),
                'bg_gradient' => 'from-violet-600 to-indigo-600',
                'icon' => 'microphone',
                'tag' => 'Live Now',
            ]);
            
            // Also show next upcoming if there's a live event
            $upcomingAfterLive = Rundown::where('start_time', '>', $now)
                ->orderBy('start_time', 'asc')
                ->first();
            
            if ($upcomingAfterLive) {
                $highlights->push([
                    'type' => 'event',
                    'title' => $upcomingAfterLive->title,
                    'subtitle' => 'Mulai jam ' . $upcomingAfterLive->start_time->format('H:i'),
                    'bg_gradient' => 'from-pink-500 to-rose-500',
                    'icon' => 'clock',
                    'tag' => 'Upcoming',
                ]);
            }
        } elseif ($nextEvent) {
            // CASE B: Ada acara UPCOMING (belum mulai)
            $highlights->push([
                'type' => 'event',
                'title' => $nextEvent->title,
                'subtitle' => 'Mulai jam ' . $nextEvent->start_time->format('H:i'),
                'bg_gradient' => 'from-pink-500 to-rose-500',
                'icon' => 'clock',
                'tag' => 'Upcoming',
            ]);
        } else {
            // CASE C: Fallback - No events (default state)
            $highlights->push([
                'type' => 'static',
                'title' => "University Day's Out 2026",
                'subtitle' => '1 Februari 2026',
                'bg_gradient' => 'from-purple-600 to-blue-600',
                'icon' => 'calendar',
                'tag' => 'Coming Soon',
            ]);
        }

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
