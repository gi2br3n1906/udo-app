@extends('layouts.app')

@section('title', $university->name)

@section('header-title')
    {{ $university->name }}
@endsection

@section('header-subtitle')
    University Profile
@endsection

@section('content')
{{-- Hero Header with Logo --}}
<div class="relative overflow-hidden bg-gradient-to-br from-purple-600 via-fuchsia-600 to-pink-600 rounded-3xl p-6 mb-5 shadow-lg shadow-purple-500/20">
    {{-- Decorative Blob --}}
    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-fuchsia-400/20 rounded-full blur-3xl"></div>
    
    <div class="relative flex items-center gap-4">
        {{-- Logo --}}
        <div class="w-20 h-20 bg-white rounded-2xl p-3 flex items-center justify-center shrink-0 shadow-lg">
            <img src="{{ $university->logo_url }}" 
                 alt="{{ $university->name }}" 
                 class="w-full h-full object-contain">
        </div>
        
        {{-- Name --}}
        <div class="flex-1">
            <h1 class="text-2xl font-bold text-white leading-tight">{{ $university->name }}</h1>
            @if($university->map_booth_id)
            <p class="text-purple-100 text-sm mt-1">📍 Booth {{ $university->map_booth_id }}</p>
            @endif
        </div>
    </div>
</div>

{{-- About Section --}}
@if($university->description)
<div class="bg-white rounded-3xl p-5 mb-4 shadow-sm">
    <h2 class="text-lg font-bold text-slate-800 mb-3 flex items-center gap-2">
        <span class="text-purple-600">📖</span>
        Tentang
    </h2>
    <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-line">{{ $university->description }}</p>
</div>
@endif

{{-- Info Cards --}}
<div class="space-y-3 mb-5">
    {{-- Booth Location --}}
    @if($university->map_booth_id)
    <div class="bg-purple-50 rounded-3xl p-5 border border-purple-100">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <div class="flex-1">
                <h3 class="font-bold text-slate-800 text-sm">Lokasi Booth</h3>
                <p class="text-slate-600 text-sm">Booth {{ $university->map_booth_id }}</p>
                <a href="{{ route('map.index') }}" class="text-purple-600 hover:text-purple-700 text-sm font-semibold inline-flex items-center gap-1 mt-1">
                    Lihat di Peta 
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    @endif

    {{-- Website --}}
    @if($university->website_url)
    <div class="bg-slate-50 rounded-3xl p-5 border border-slate-100">
        <div class="flex items-start gap-3">
            <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="font-bold text-slate-800 text-sm">Official Website</h3>
                <a href="{{ $university->website_url }}" 
                   target="_blank"
                   class="text-purple-600 hover:text-purple-700 text-sm font-medium truncate block">
                    {{ $university->website_url }}
                </a>
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Action Buttons --}}
<div class="flex gap-3 mb-6">
    <a href="{{ route('universities.index') }}" 
       class="flex-1 py-3.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-3xl text-center transition-colors text-sm">
        ← Kembali
    </a>
    
    @if($university->map_booth_id)
    <a href="{{ route('map.index') }}" 
       class="flex-1 py-3.5 px-4 bg-gradient-to-r from-purple-600 to-fuchsia-600 hover:from-purple-700 hover:to-fuchsia-700 text-white font-semibold rounded-3xl text-center shadow-lg shadow-purple-500/20 transition-all text-sm">
        📍 Lihat Peta
    </a>
    @endif
</div>
@endsection
