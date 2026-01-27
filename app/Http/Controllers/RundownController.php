<?php

namespace App\Http\Controllers;

use App\Models\Rundown;
use Carbon\Carbon;

class RundownController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        // Group rundowns by date
        $rundowns = Rundown::orderBy('start_time', 'asc')
            ->get()
            ->groupBy(function ($rundown) {
                return $rundown->start_time->format('Y-m-d');
            });

        // Identify current/ongoing events
        $currentRundown = Rundown::where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->first();

        return view('rundown.index', compact('rundowns', 'currentRundown'));
    }
}
