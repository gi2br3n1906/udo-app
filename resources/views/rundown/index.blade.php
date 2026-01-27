@extends('layouts.app')

@section('title', 'Rundown Acara')

@section('header-title')
    Rundown Acara
@endsection

@section('header-subtitle')
    Jadwal Event Hari Ini
@endsection

@section('content')
{{-- Current Event Highlight --}}
@if($currentRundown)
<div class="relative overflow-hidden bg-gradient-to-br from-purple-600 via-fuchsia-600 to-pink-600 rounded-3xl p-5 mb-5 shadow-lg shadow-purple-500/20">
    {{-- Decorative Blob --}}
    <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
    
    <div class="relative">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-bold rounded-full mb-3">
            <span class="w-2 h-2 bg-white rounded-full animate-pulse"></span>
            SEDANG BERLANGSUNG
        </span>
        
        <h2 class="text-xl font-bold text-white leading-tight mb-2">{{ $currentRundown->title }}</h2>
        <p class="text-purple-100 text-sm">
            {{ $currentRundown->start_time->format('H:i') }} - {{ $currentRundown->end_time->format('H:i') }} WIB
        </p>
        
        @if($currentRundown->description)
        <p class="text-white text-sm mt-3 leading-relaxed">{{ $currentRundown->description }}</p>
        @endif
    </div>
</div>
@endif

{{-- Timeline by Date --}}
@if($rundowns->count() > 0)
    @foreach($rundowns as $date => $dayRundowns)
    <div class="mb-6">
        {{-- Date Header --}}
        <div class="sticky top-20 z-10 bg-gradient-to-b from-slate-50 to-transparent pt-2 pb-3 mb-3">
            <h2 class="text-lg font-bold text-slate-800">
                {{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}
            </h2>
        </div>

        {{-- Events for this Date --}}
        <div class="space-y-3">
            @foreach($dayRundowns as $rundown)
                @php
                    $now = \Carbon\Carbon::now();
                    $isUpcoming = $rundown->start_time->isFuture();
                    $isOngoing = $rundown->start_time->isPast() && $rundown->end_time->isFuture();
                    $isPast = $rundown->end_time->isPast();
                @endphp

                <div class="bg-white rounded-3xl p-5 shadow-sm {{ $isOngoing ? 'ring-2 ring-purple-500 shadow-lg shadow-purple-500/10' : '' }}">
                    {{-- Time Badge --}}
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 {{ $isOngoing ? 'bg-purple-100 text-purple-700' : 'bg-slate-100 text-slate-600' }} rounded-full text-sm font-semibold mb-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ $rundown->start_time->format('H:i') }} - {{ $rundown->end_time->format('H:i') }}
                    </div>

                    {{-- Title --}}
                    <h3 class="text-lg font-bold text-slate-800 mb-2 leading-tight">{{ $rundown->title }}</h3>

                    {{-- Description --}}
                    @if($rundown->description)
                    <p class="text-slate-600 text-sm leading-relaxed mb-3">{{ $rundown->description }}</p>
                    @endif

                    {{-- Status Badge --}}
                    <div class="flex items-center gap-2">
                        @if($isOngoing)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-purple-100 text-purple-700 text-xs font-bold rounded-full">
                            <span class="w-2 h-2 bg-purple-500 rounded-full animate-pulse"></span>
                            Sedang Berlangsung
                        </span>
                        @elseif($isUpcoming)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">
                            ⏱ Akan Datang
                        </span>
                        @elseif($isPast)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 text-slate-500 text-xs font-bold rounded-full">
                            ✓ Selesai
                        </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endforeach
@else
<div class="bg-white rounded-3xl p-8 text-center shadow-sm">
    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
    </div>
    <p class="text-slate-500 text-sm">Belum ada rundown acara yang tersedia.</p>
</div>
@endif
@endsection
