<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <title>Welcome to UDO Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom animations if not in Tailwind config yet */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }
        .animate-blob {
            animation: blob 7s infinite;
        }
        .animation-delay-2000 {
            animation-delay: 2s;
        }
        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>
</head>
<body class="h-full bg-slate-950 text-white font-sans antialiased selection:bg-purple-500 selection:text-white">

    <div class="min-h-full w-full flex flex-col items-center justify-center p-6 relative overflow-hidden">
        
        <!-- Ambient Background Effects -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-purple-600 rounded-full mix-blend-screen filter blur-[100px] opacity-30 animate-blob"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-fuchsia-600 rounded-full mix-blend-screen filter blur-[100px] opacity-30 animate-blob animation-delay-2000"></div>

        <!-- Main Card -->
        <div class="relative z-10 w-full max-w-sm">
            
            <div class="text-center mb-10">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-500 to-fuchsia-600 shadow-lg shadow-purple-500/30 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.499 5.216 50.592 50.592 0 00-2.658.812m-15.482 0a50.57 50.57 0 012.658-.813m15.482 0a50.57 50.57 0 01-2.658-.812" />
                    </svg>
                </div>
                <h1 class="text-4xl font-bold tracking-tight mb-2">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-fuchsia-400 to-purple-400">UDO Platform</span>
                </h1>
                <p class="text-slate-400 text-lg">Gateway to University Day's Out</p>
            </div>

            <form action="{{ route('visitor.store') }}" method="POST" class="flex flex-col gap-5">
                @csrf
                
                <div class="space-y-1">
                    <label for="name" class="text-sm font-medium text-slate-300 ml-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" required placeholder="John Doe"
                        class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all placeholder:text-slate-600 text-white shadow-inner">
                    @error('name') <span class="text-red-400 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1">
                    <label for="school_origin" class="text-sm font-medium text-slate-300 ml-1">Asal Sekolah</label>
                    <input type="text" name="school_origin" id="school_origin" required placeholder="SMA Negeri 1 ..."
                        class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all placeholder:text-slate-600 text-white shadow-inner">
                    @error('school_origin') <span class="text-red-400 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1">
                    <label for="class" class="text-sm font-medium text-slate-300 ml-1">Kelas</label>
                    <select name="class" id="class" required
                        class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all text-white shadow-inner appearance-none cursor-pointer">
                        <option value="" disabled selected class="text-slate-600">Pilih Kelas</option>
                        <option value="X" class="bg-slate-900">Kelas X</option>
                        <option value="XI" class="bg-slate-900">Kelas XI</option>
                        <option value="XII" class="bg-slate-900">Kelas XII</option>
                        <option value="Alumni" class="bg-slate-900">Alumni / Umum</option>
                    </select>
                    @error('class') <span class="text-red-400 text-xs ml-1">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="mt-4 w-full bg-gradient-to-r from-purple-600 to-fuchsia-600 hover:from-purple-500 hover:to-fuchsia-500 text-white font-bold py-4 rounded-3xl shadow-lg shadow-purple-600/30 transform active:scale-[0.98] transition-all flex items-center justify-center gap-2 group">
                    <span>Masuk sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </button>
            </form>

            <p class="text-center text-slate-500 text-sm mt-8">
                &copy; {{ date('Y') }} UDO Platform. All rights reserved.
            </p>
        </div>
    </div>

</body>
</html>
