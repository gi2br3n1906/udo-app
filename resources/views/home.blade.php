@extends('layouts.app')

@section('title', 'Beranda')

@section('header-title')
    Hai, {{ explode(' ', request()->cookie('visitor_name') ?? 'Pengunjung')[0] }}!
@endsection

@section('header-subtitle')
    Ayo jelajahi acaranya
@endsection

@section('content')

<!-- Section A: Hero Carousel (Highlights & Platinum) -->
<div class="mt-4 mb-6" x-data="{ 
    activeSlide: 0, 
    slides: {{ count($carouselItems) }},
    next() { this.activeSlide = (this.activeSlide + 1) % this.slides },
    prev() { this.activeSlide = (this.activeSlide - 1 + this.slides) % this.slides },
    autoPlay() { setInterval(() => this.next(), 5000) }
}" x-init="autoPlay">
    
    <div class="relative w-full overflow-hidden rounded-3xl shadow-xl shadow-purple-500/10">
        <!-- Slides Container -->
        <div class="flex transition-transform duration-500 ease-out h-48 sm:h-56" 
             :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
            
            @foreach($carouselItems as $item)
            <div class="min-w-full w-full h-full relative p-6 flex flex-col justify-end text-white overflow-hidden bg-gradient-to-br {{ $item['bg_gradient'] }}">
                
                <!-- Background Pattern/Icon overlay -->
                <div class="absolute -top-4 -right-4 opacity-20 transform rotate-12">
                    @if(isset($item['icon']))
                        @if($item['icon'] == 'microphone')
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 2.34 9 5v6c0 1.66 1.34 3 3 3z"/><path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/></svg>
                        @elseif($item['icon'] == 'star')
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        @elseif($item['icon'] == 'gift')
                             <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M20 6h-2.18c.11-.31.18-.65.18-1 0-1.66-1.34-3-3-3-1.05 0-1.96.54-2.5 1.35l-.5.67-.5-.68C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-2 .89-2 2v12c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM9 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm11 15H4v-2h16v2zm0-5H4V8h5.08L7 10.83 8.62 12 11 8.76l1-1.36 1 1.36L15.38 12 17 10.83 14.92 8H20v6z"/></svg>
                        @endif
                    @elseif(isset($item['image']) && $item['type'] == 'sponsor')
                         <!-- Sponsor Logo as BG -->
                          <img src="{{ $item['image'] }}" class="w-32 h-32 object-contain opacity-50 grayscale brightness-200">
                    @endif
                </div>

                <!-- Content -->
                <div class="relative z-10">
                    <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-[10px] font-bold uppercase tracking-wider mb-2 border border-white/10">
                        {{ $item['tag'] }}
                    </span>
                    <h3 class="text-2xl font-bold leading-tight mb-1">{{ $item['title'] }}</h3>
                    <p class="text-sm opacity-90 font-medium tracking-wide">{{ $item['subtitle'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Indicators -->
        <div class="absolute bottom-4 right-4 flex space-x-1.5 z-20">
            <template x-for="i in slides">
                <button @click="activeSlide = i - 1" class="h-1.5 rounded-full transition-all duration-300" 
                    :class="activeSlide === i - 1 ? 'w-6 bg-white' : 'w-1.5 bg-white/40'"></button>
            </template>
        </div>
    </div>
</div>

<!-- Section B: Gold Sponsor Ticker (Marquee) -->
@if($goldSponsors->count() > 0)
<div class="mb-8 relative overflow-hidden bg-white/50 backdrop-blur-sm border-y border-white/20 py-4 shadow-sm">
    {{-- Fade edges for elegant look --}}
    <div class="absolute left-0 top-0 bottom-0 w-16 z-10 bg-gradient-to-r from-slate-50 to-transparent pointer-events-none"></div>
    <div class="absolute right-0 top-0 bottom-0 w-16 z-10 bg-gradient-to-l from-slate-50 to-transparent pointer-events-none"></div>
    
    <div class="flex animate-marquee items-center gap-16 whitespace-nowrap px-12">
        {{-- Duplicate content twice for seamless loop --}}
        @for($i = 0; $i < 2; $i++) 
            @foreach($goldSponsors as $sponsor)
                <div class="flex items-center gap-3 group">
                    <img 
                        src="{{ $sponsor->logo_url }}" 
                        alt="{{ $sponsor->name }}" 
                        class="h-10 w-auto object-contain grayscale opacity-60 hover:grayscale-0 hover:opacity-100 transition-all duration-300"
                    >
                    <span class="text-sm font-semibold text-slate-400 uppercase tracking-wide group-hover:text-slate-700 transition-colors duration-300">{{ $sponsor->name }}</span>
                </div>
            @endforeach
        @endfor
    </div>
</div>

<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        animation: marquee 30s linear infinite;
        width: fit-content; 
    }
    .animate-marquee:hover {
        animation-play-state: paused;
    }
</style>
@endif

<!-- Section C: Main Menu (Bento Grid) -->
<h2 class="text-lg font-bold text-slate-800 mb-4 px-1">Jelajahi</h2>
<div class="grid grid-cols-2 gap-4 mb-8">
    
    <!-- Card 1: Map -->
    <a href="{{ route('map.index') }}" class="col-span-1 bg-white p-5 rounded-3xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] hover:shadow-lg transition-all active:scale-[0.98] group flex flex-col h-40 relative overflow-hidden border border-slate-100">
        <div class="absolute top-0 right-0 p-4 opacity-[0.03] group-hover:opacity-10 transition-opacity">
            <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M20.5 3l-.16.03L15 5.1 9 3 3.36 4.9c-.21.07-.36.25-.36.48V20.5c0 .28.22.5.5.5l.16-.03L9 18.9l6 2.1 5.64-1.9c.21-.07.36-.25.36-.48V3.5c0-.28-.22-.5-.5-.5zM15 19l-6-2.11V5l6 2.11V19z"/></svg> 
        </div>
        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-auto group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300 shadow-sm">
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
            </svg>
        </div>
        <div>
            <h3 class="font-bold text-slate-800 text-lg leading-tight">Peta Lokasi</h3>
            <span class="text-xs text-slate-400 font-medium">Cari Booth</span>
        </div>
    </a>

    <!-- Card 2: Universities -->
    <a href="{{ route('universities.index') }}" class="col-span-1 bg-white p-5 rounded-3xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] hover:shadow-lg transition-all active:scale-[0.98] group flex flex-col h-40 relative overflow-hidden border border-slate-100">
        <div class="absolute top-0 right-0 p-4 opacity-[0.03] group-hover:opacity-10 transition-opacity">
            <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
        </div>
        <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-auto group-hover:bg-purple-600 group-hover:text-white transition-colors duration-300 shadow-sm">
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.499 5.216 50.592 50.592 0 00-2.658.812m-15.482 0a50.57 50.57 0 012.658-.813m15.482 0a50.57 50.57 0 01-2.658-.812" />
            </svg>
        </div>
        <div>
            <h3 class="font-bold text-slate-800 text-lg leading-tight">Daftar Kampus</h3>
            <span class="text-xs text-slate-400 font-medium">Jelajahi Jurusan</span>
        </div>
    </a>

    <!-- Card 3: UMKM -->
    <a href="{{ route('umkm.index') }}" class="col-span-1 bg-white p-5 rounded-3xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] hover:shadow-lg transition-all active:scale-[0.98] group flex flex-col h-40 relative overflow-hidden border border-slate-100">
        <div class="absolute top-0 right-0 p-4 opacity-[0.03] group-hover:opacity-10 transition-opacity">
            <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/></svg>
        </div>
        <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center mb-auto group-hover:bg-orange-500 group-hover:text-white transition-colors duration-300 shadow-sm">
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
            </svg>
        </div>
        <div>
            <h3 class="font-bold text-slate-800 text-lg leading-tight">Makanan & Bazar</h3>
            <span class="text-xs text-slate-400 font-medium">Jajanan & Lainnya</span>
        </div>
    </a>

    <!-- Card 4: Rundown -->
    <a href="{{ route('rundown.index') }}" class="col-span-1 bg-white p-5 rounded-3xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] hover:shadow-lg transition-all active:scale-[0.98] group flex flex-col h-40 relative overflow-hidden border border-slate-100">
        <div class="absolute top-0 right-0 p-4 opacity-[0.03] group-hover:opacity-10 transition-opacity">
           <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/></svg>
        </div>
        <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center mb-auto group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300 shadow-sm">
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div>
            <h3 class="font-bold text-slate-800 text-lg leading-tight">Jadwal Acara</h3>
            <span class="text-xs text-slate-400 font-medium">Acara Langsung</span>
        </div>
    </a>
</div>

<!-- "New on UDO" Title -->
<h2 class="text-lg font-bold text-slate-800 mb-4 px-2">Universitas Peserta</h2>
<div class="space-y-3 mb-8">
    @foreach(App\Models\University::take(3)->get() as $uni)
    <div x-data="{ 
        isFavorite: false,
        toggleFavorite() {
            fetch('/universities/{{ $uni->id }}/toggle-favorite', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    this.isFavorite = (data.status === 'added');
                }
            })
            .catch(err => console.error(err));
        }
    }" class="relative flex items-center gap-4 p-4 bg-white rounded-2xl border border-slate-100 shadow-sm">
        <a href="{{ route('universities.show', $uni->slug) }}" class="flex items-center gap-4 flex-1">
            <div class="w-12 h-12 bg-slate-100 rounded-xl flex items-center justify-center shrink-0 overflow-hidden">
                 @if($uni->logo_path)
                    <img src="{{ $uni->logo_url }}" alt="{{ $uni->name }}" class="w-full h-full object-cover">
                 @else
                    <span class="text-xs font-bold text-slate-400">{{ substr($uni->name, 0, 2) }}</span>
                 @endif
            </div>
            <div>
                <h3 class="font-bold text-slate-800">{{ $uni->name }}</h3>
                <p class="text-xs text-slate-500 line-clamp-1">{{ Str::limit($uni->description, 40) }}</p>
            </div>
        </a>
        
        {{-- Heart Icon Button --}}
        <button @click.prevent="toggleFavorite()" class="shrink-0 w-10 h-10 flex items-center justify-center rounded-full hover:bg-slate-50 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 transition-colors" viewBox="0 0 24 24" :fill="isFavorite ? '#7c3aed' : 'none'" :stroke="isFavorite ? '#7c3aed' : 'currentColor'" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </button>
    </div>
    @endforeach
</div>

<!-- Section D: Secondary Actions -->
<div class="grid grid-cols-2 gap-4">
    <button class="flex items-center gap-3 p-4 bg-white border border-slate-100 rounded-2xl shadow-sm active:scale-95 transition-transform">
        <div class="w-10 h-10 rounded-full bg-pink-100 text-pink-500 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
        </div>
        <div class="text-left">
            <span class="block text-sm font-bold text-slate-800">Vote Favorit</span>
            <span class="block text-[10px] text-slate-500">Dukung Kampus</span>
        </div>
    </button>
    
    <button class="flex items-center gap-3 p-4 bg-white border border-slate-100 rounded-2xl shadow-sm active:scale-95 transition-transform">
        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
             <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
        </div>
        <div class="text-left">
            <span class="block text-sm font-bold text-slate-800">Partner</span>
            <span class="block text-[10px] text-slate-500">Daftar Sponsor</span>
        </div>
    </button>
</div>

@endsection
