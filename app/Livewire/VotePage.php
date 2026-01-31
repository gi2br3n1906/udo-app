<?php

namespace App\Livewire;

use App\Models\University;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class VotePage extends Component
{
    public bool $hasVoted = false;
    public ?int $votedUniversityId = null;
    public ?University $votedUniversity = null;

    public function mount()
    {
        // Check if user has already voted in this session
        if (session()->has('has_voted')) {
            $this->hasVoted = true;
            $this->votedUniversityId = session()->get('voted_university');
            $this->votedUniversity = University::find($this->votedUniversityId);
        }
    }

    public function vote(int $universityId)
    {
        // Prevent double voting
        if (session()->has('has_voted')) {
            return;
        }

        // Find the university
        $university = University::find($universityId);
        if (!$university) {
            return;
        }

        // Increment vote count (assuming votes_count column exists)
        $university->increment('votes_count');

        // Lock session
        session()->put('has_voted', true);
        session()->put('voted_university', $universityId);

        // Update component state
        $this->hasVoted = true;
        $this->votedUniversityId = $universityId;
        $this->votedUniversity = $university;

        // Dispatch event for any JS listeners (e.g., confetti, toast)
        $this->dispatch('vote-submitted', universityName: $university->name);
    }

    public function render()
    {
        $universities = University::orderBy('name')->get();
        
        // Get top voted universities for results display
        $topVoted = University::where('votes_count', '>', 0)
            ->orderByDesc('votes_count')
            ->take(5)
            ->get();

        return view('livewire.vote-page', [
            'universities' => $universities,
            'topVoted' => $topVoted,
        ]);
    }
}
