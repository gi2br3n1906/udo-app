@extends('layouts.app')

@section('title', $umkm->name)

@section('header-title')
    {{ $umkm->name }}
@endsection

@section('header-subtitle')
    UMKM Profile
@endsection

@section('content')
{{-- Hero Header --}}
<div class="relative overflow-hidden bg-gradient-to-br from-purple-600 via-fuchsia-600 to-pink-600 rounded-3xl p-6 mb-5 shadow-lg shadow-purple-500/20">
    {{-- Decorative Blobs --}}
    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-fuchsia-400/20 rounded-full blur-3xl"></div>
    
    <div class="relative">
        <h1 class="text-2xl font-bold text-white leading-tight mb-2">{{ $umkm->name }}</h1>
        
        <div class="flex items-center gap-3">
            @if($umkm->price_range)
            <span class="text-purple-100 text-sm flex items-center gap-1">
                <span>💰</span>
                {{ $umkm->price_range }}
            </span>
            @endif
            
            @if($umkm->map_booth_id)
            <span class="text-purple-100 text-sm flex items-center gap-1">
                <span>📍</span>
                Booth {{ $umkm->map_booth_id }}
            </span>
            @endif
        </div>
    </div>
</div>

{{-- About Section --}}
<div class="bg-white rounded-3xl p-5 mb-4 shadow-sm">
    <h2 class="text-lg font-bold text-slate-800 mb-3 flex items-center gap-2">
        <span class="text-purple-600">ℹ️</span>
        Tentang
    </h2>
    <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-line">{{ $umkm->description }}</p>
</div>

{{-- Menu Section --}}
@if($umkm->menu_list && count($umkm->menu_list) > 0)
<div class="bg-white rounded-3xl p-5 mb-4 shadow-sm">
    <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
        <span class="text-purple-600">🍽️</span>
        Daftar Menu
    </h2>
    
    <div class="flex flex-wrap gap-2">
        @foreach($umkm->menu_list as $menu)
        <span class="inline-flex items-center gap-1.5 px-4 py-2 bg-purple-50 text-purple-700 text-sm font-medium rounded-full border border-purple-100">
            <span class="text-base">{{ is_array($menu) ? ($menu['icon'] ?? '🍴') : '🍴' }}</span>
            {{ is_array($menu) ? ($menu['item'] ?? $menu) : $menu }}
        </span>
        @endforeach
    </div>
</div>
@endif

{{-- Location Card --}}
@if($umkm->map_booth_id)
<div class="bg-purple-50 rounded-3xl p-5 mb-5 border border-purple-100">
    <div class="flex items-start gap-3">
        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center shrink-0">
            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
        <div class="flex-1">
            <h3 class="font-bold text-slate-800 text-sm">Lokasi Booth</h3>
            <p class="text-slate-600 text-sm">Booth {{ $umkm->map_booth_id }}</p>
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

{{-- Action Buttons --}}
<div class="flex gap-3 mb-6">
    <a href="{{ route('umkm.index') }}" 
       class="flex-1 py-3.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold rounded-3xl text-center transition-colors text-sm">
        ← Kembali
    </a>
    
    @if($umkm->map_booth_id)
    <a href="{{ route('map.index') }}" 
       class="flex-1 py-3.5 px-4 bg-gradient-to-r from-purple-600 to-fuchsia-600 hover:from-purple-700 hover:to-fuchsia-700 text-white font-semibold rounded-3xl text-center shadow-lg shadow-purple-500/20 transition-all text-sm">
        📍 Lihat Peta
    </a>
    @endif
</div>
@endsection
