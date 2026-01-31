@extends('layouts.app')

@section('header-title', 'Partner & Sponsor')
@section('header-subtitle', 'Terima kasih atas dukungannya')

@section('content')
<div class="pt-24 space-y-8">

    @forelse($sponsors as $type => $sponsorGroup)
        <div>
            <h2 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                @if($type === 'Mega Platinum')
                    <span class="w-3 h-3 rounded-full bg-gradient-to-r from-purple-500 to-pink-500"></span>
                @elseif($type === 'Platinum')
                    <span class="w-3 h-3 rounded-full bg-slate-400"></span>
                @elseif($type === 'Gold')
                    <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                @elseif($type === 'Silver')
                    <span class="w-3 h-3 rounded-full bg-slate-300"></span>
                @elseif($type === 'Bronze')
                    <span class="w-3 h-3 rounded-full bg-amber-600"></span>
                @else
                    <span class="w-3 h-3 rounded-full bg-blue-400"></span>
                @endif
                {{ $type }}
            </h2>
            
            <div class="grid grid-cols-2 gap-4">
                @foreach($sponsorGroup as $sponsor)
                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm flex flex-col items-center text-center">
                        <div class="w-20 h-20 bg-slate-50 rounded-xl flex items-center justify-center mb-3 overflow-hidden">
                            @if($sponsor->logo_path)
                                <img src="{{ $sponsor->logo_url }}" alt="{{ $sponsor->name }}" class="w-full h-full object-contain p-2">
                            @else
                                <span class="text-2xl font-bold text-slate-300">{{ substr($sponsor->name, 0, 2) }}</span>
                            @endif
                        </div>
                        <h3 class="font-semibold text-slate-800 text-sm">{{ $sponsor->name }}</h3>
                        <span class="text-xs text-slate-400 mt-1">{{ $type }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="text-center py-12">
            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>
            </div>
            <h3 class="font-semibold text-slate-600 mb-1">Belum Ada Sponsor</h3>
            <p class="text-sm text-slate-400">Sponsor akan ditampilkan di sini</p>
        </div>
    @endforelse

</div>
@endsection
