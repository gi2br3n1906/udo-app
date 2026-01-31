@extends('layouts.app')

@section('title', 'Katalog Universitas')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-50 to-white -mx-5 px-5">
    {{-- Header Section --}}
    <div class="mb-8 text-center pt-6">
        <span class="px-3 py-1 rounded-full bg-purple-100 text-purple-600 text-xs font-bold tracking-wider uppercase mb-2 inline-block">
            Edukasi Masa Depan
        </span>
        <h2 class="text-3xl font-bold text-gray-900">Jelajahi Kampus</h2>
        <p class="text-gray-500 mt-2 text-sm">Temukan universitas terbaik untuk masa depanmu</p>
    </div>

    <div class="pb-8">
        @if($universities->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6 px-2">
            @foreach($universities as $university)
            <a href="{{ route('universities.show', $university->slug) }}" class="group relative bg-white rounded-2xl p-4 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-gray-100 h-full flex flex-col">
                
                {{-- Logo Container --}}
                <div class="relative w-full aspect-[4/3] bg-gray-50 rounded-xl mb-4 flex items-center justify-center p-4 overflow-hidden group-hover:bg-purple-50 transition-colors">
                    @if($university->logo_path)
                        <img src="{{ $university->logo_url }}" alt="{{ $university->name }}" class="w-full h-full object-contain drop-shadow-sm group-hover:scale-110 transition-transform duration-500">
                    @else
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    @endif
                </div>

                {{-- Text Content --}}
                <div class="text-center mt-auto">
                    <h3 class="font-bold text-gray-800 text-sm md:text-base leading-tight group-hover:text-purple-700 transition-colors line-clamp-2">
                        {{ $university->name }}
                    </h3>
                    <div class="mt-3 flex justify-center">
                        <span class="text-[10px] font-semibold text-gray-400 uppercase tracking-widest border-b border-transparent group-hover:border-purple-300 group-hover:text-purple-500 transition-all">
                            Lihat Profil
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="mt-8 px-2">
            {{ $universities->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <div class="w-20 h-20 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <h3 class="font-semibold text-gray-700 mb-1 text-lg">Belum Ada Kampus</h3>
            <p class="text-sm text-gray-400">Data kampus akan segera hadir</p>
        </div>
        @endif
    </div>
</div>
@endsection
