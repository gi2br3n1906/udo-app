<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- PWA Manifest --}}
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#7c3aed">
    
    {{-- iOS PWA Support --}}
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="UDO 2026">

    <title>@yield('title', 'UDO')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full bg-slate-50 text-slate-900 font-sans antialiased pb-24 pt-20">

    <!-- Sticky Header -->
    <header class="fixed top-0 left-0 right-0 z-40 bg-white/80 backdrop-blur-md border-b border-slate-200 px-5 py-4 flex items-center justify-between shadow-sm transition-all duration-300">
        <div>
            <!-- Personalized Greeting Placeholder - Will be hydrated by view/controller -->
            <h1 class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-fuchsia-600">
                @yield('header-title', 'UDO Platform')
            </h1>
            <p class="text-xs text-slate-500 font-medium">@yield('header-subtitle', 'University Day\'s Out')</p>
        </div>
        <div class="flex items-center gap-3">
            <!-- Optional Top Actions e.g. Notifications -->
            <button class="relative w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 hover:bg-slate-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
                <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="px-5 w-full mx-auto max-w-lg">
        @yield('content')
    </main>

    <!-- Bottom Navigation Bar (Fixed) -->
    <nav class="fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-slate-200 pb-safe pt-2 px-6 flex justify-between items-center shadow-[0_-4px_20px_rgba(0,0,0,0.05)]">
        <!-- Home -->
        <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 p-2 group {{ request()->routeIs('home') ? 'text-purple-600' : 'text-slate-400 hover:text-slate-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition-colors group-active:scale-90" viewBox="0 0 24 24" fill="{{ request()->routeIs('home') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ request()->routeIs('home') ? '0' : '2' }}">
               <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9L12 3l8.25 6v10.5a.75.75 0 01-.75.75h-4.5a.75.75 0 01-.75-.75V15a1.5 1.5 0 00-1.5-1.5h-3a1.5 1.5 0 00-1.5 1.5v4.5a.75.75 0 01-.75.75h-4.5a.75.75 0 01-.75-.75V9z" />
            </svg>
            <span class="text-[10px] font-medium">Home</span>
        </a>

        <!-- Map -->
        <a href="{{ route('map.index') }}" class="flex flex-col items-center gap-1 p-2 group {{ request()->routeIs('map.*') ? 'text-purple-600' : 'text-slate-400 hover:text-slate-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition-colors group-active:scale-90" viewBox="0 0 24 24" fill="{{ request()->routeIs('map.*') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ request()->routeIs('map.*') ? '0' : '2' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
            </svg>
            <span class="text-[10px] font-medium">Map</span>
        </a>

        <!-- Rundown -->
        <a href="{{ route('rundown.index') }}" class="flex flex-col items-center gap-1 p-2 group {{ request()->routeIs('rundown.*') ? 'text-purple-600' : 'text-slate-400 hover:text-slate-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition-colors group-active:scale-90" viewBox="0 0 24 24" fill="{{ request()->routeIs('rundown.*') ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ request()->routeIs('rundown.*') ? '0' : '2' }}">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-[10px] font-medium">Rundown</span>
        </a>

        <!-- Profile/Menu -->
        <a href="#" class="flex flex-col items-center gap-1 p-2 group {{ request()->routeIs('profile.*') ? 'text-purple-600' : 'text-slate-400 hover:text-slate-600' }}">
             <div class="w-6 h-6 rounded-full bg-slate-200 overflow-hidden border-2 {{ request()->routeIs('profile.*') ? 'border-purple-600' : 'border-transparent' }}">
                 <!-- Avatar Placeholder -->
                 <svg class="h-full w-full text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                     <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                 </svg>
             </div>
            <span class="text-[10px] font-medium">Me</span>
        </a>

    </nav>

    @stack('scripts')
</body>
</html>
