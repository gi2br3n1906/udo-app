<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'UDO Platform') }} - University Days Out</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
        }

        /* ========== ANIMATIONS ========== */
        @keyframes blob-float-1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
        }

        @keyframes blob-float-2 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(-40px, 30px) scale(1.05); }
            66% { transform: translate(25px, -40px) scale(0.95); }
        }

        @keyframes blob-float-3 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(20px, 30px) scale(1.08); }
        }

        @keyframes logo-pulse {
            0%, 100% {
                transform: scale(1);
                filter: drop-shadow(0 0 30px rgba(168, 85, 247, 0.6));
            }
            50% {
                transform: scale(1.15);
                filter: drop-shadow(0 0 60px rgba(168, 85, 247, 1)) drop-shadow(0 0 100px rgba(236, 72, 153, 0.8));
            }
        }

        @keyframes cloud-move-left {
            0% { transform: translateX(-100%); opacity: 0; }
            10% { opacity: 0.8; }
            90% { opacity: 0.8; }
            100% { transform: translateX(calc(100vw + 100%)); opacity: 0; }
        }

        @keyframes cloud-move-right {
            0% { transform: translateX(100vw); opacity: 0; }
            10% { opacity: 0.6; }
            90% { opacity: 0.6; }
            100% { transform: translateX(calc(-100% - 100vw)); opacity: 0; }
        }

        @keyframes gradient-btn {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes float-card {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .blob-1 { animation: blob-float-1 8s ease-in-out infinite; }
        .blob-2 { animation: blob-float-2 10s ease-in-out infinite; }
        .blob-3 { animation: blob-float-3 12s ease-in-out infinite; }
        .animate-logo-pulse { animation: logo-pulse 2s ease-in-out infinite; }
        .animate-cloud-left { animation: cloud-move-left 10s linear infinite; }
        .animate-cloud-right { animation: cloud-move-right 14s linear infinite; }
        .animate-gradient-btn { 
            background-size: 200% 200%; 
            animation: gradient-btn 3s ease infinite; 
        }
        .animate-float-card { animation: float-card 6s ease-in-out infinite; }
        .animate-fade-in { animation: fade-in-up 0.5s ease-out forwards; }

        /* ========== FROSTED GLASS ========== */
        .frosted-glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .frosted-input {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            color: white !important;
            -webkit-text-fill-color: white;
        }

        .frosted-input:focus {
            background: rgba(255, 255, 255, 0.12);
            border-color: rgba(168, 85, 247, 0.6);
            box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.15), 0 0 30px rgba(168, 85, 247, 0.2);
        }

        /* Gradient text */
        .text-gradient {
            background: linear-gradient(135deg, #a855f7, #ec4899, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Hide number spinners */
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] { -moz-appearance: textfield; }
    </style>
</head>

<body class="min-h-screen overflow-x-hidden">

    <!-- ==================== BACKGROUND ==================== -->
    <div class="fixed inset-0 bg-gradient-to-br from-[#0f0a1e] via-[#1a0d2e] to-[#0a0612]">
        <!-- Gradient overlays -->
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,rgba(120,50,180,0.15),transparent_40%)]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_80%,rgba(180,50,120,0.1),transparent_40%)]"></div>
    </div>

    <!-- ==================== FLOATING BLOBS (VISIBLE THROUGH GLASS) ==================== -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <!-- Blob 1: Large Purple - Top Right -->
        <div class="blob-1 absolute top-[-10%] right-[-5%] w-[500px] h-[500px] rounded-full bg-purple-600/30 blur-3xl"></div>
        
        <!-- Blob 2: Pink - Bottom Left -->
        <div class="blob-2 absolute bottom-[-15%] left-[-10%] w-[600px] h-[600px] rounded-full bg-pink-600/25 blur-3xl"></div>
        
        <!-- Blob 3: Indigo - Center Behind Card -->
        <div class="blob-3 absolute top-[30%] left-[30%] w-[400px] h-[400px] rounded-full bg-indigo-500/20 blur-3xl"></div>

        <!-- Blob 4: Cyan accent -->
        <div class="blob-1 absolute top-[60%] right-[20%] w-[300px] h-[300px] rounded-full bg-cyan-500/15 blur-3xl" style="animation-delay: -4s;"></div>
    </div>

    <!-- ==================== FLOATING CLOUDS (Background Decoration) ==================== -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none opacity-30">
        <svg class="absolute top-[15%] w-64 h-32 blob-1" viewBox="0 0 200 100" style="animation-delay: -2s;">
            <ellipse cx="50" cy="60" rx="40" ry="28" fill="white" opacity="0.4"/>
            <ellipse cx="95" cy="50" rx="50" ry="35" fill="white" opacity="0.4"/>
            <ellipse cx="145" cy="58" rx="42" ry="28" fill="white" opacity="0.4"/>
            <ellipse cx="70" cy="40" rx="30" ry="20" fill="white" opacity="0.4"/>
        </svg>

        <svg class="absolute bottom-[20%] right-0 w-72 h-36 blob-2" viewBox="0 0 200 100">
            <ellipse cx="45" cy="55" rx="38" ry="26" fill="white" opacity="0.3"/>
            <ellipse cx="100" cy="50" rx="52" ry="36" fill="white" opacity="0.3"/>
            <ellipse cx="155" cy="56" rx="40" ry="28" fill="white" opacity="0.3"/>
        </svg>
    </div>

    <!-- ==================== MAIN CONTENT ==================== -->
    <div class="relative z-10 min-h-screen flex items-center justify-center px-4 py-10">
        
        <!-- Navigation -->
        @if (Route::has('login'))
        <nav class="fixed top-5 right-5 z-20">
            @auth
                <a href="{{ url('/admin') }}" class="px-4 py-2 text-sm text-white/70 hover:text-white frosted-glass rounded-xl transition-all duration-300 hover:bg-white/20">
                    Dasbor
                </a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm text-white/50 hover:text-white transition-colors">
                    Masuk
                </a>
            @endauth
        </nav>
        @endif

        <!-- ========== FROSTED GLASS CARD ========== -->
        <main class="w-full max-w-md animate-float-card">
            <div class="frosted-glass rounded-3xl overflow-hidden">
                
                <!-- Header -->
                <div class="pt-8 pb-4 px-6 text-center relative z-10">
                    <div class="flex justify-center mb-4">
                        <img 
                            src="{{ asset('logo.png') }}" 
                            alt="Logo UDO" 
                            class="w-16 h-16 md:w-24 md:h-24 object-contain drop-shadow-[0_0_15px_rgba(168,85,247,0.5)]"
                        >
                    </div>

                    <div class="space-y-1">
                        <p class="text-white/60 text-xs md:text-sm font-medium tracking-wider uppercase">
                            Selamat Datang di
                        </p>

                        <h1 class="text-2xl md:text-3xl font-bold text-white leading-tight drop-shadow-md">
                            <span class="bg-clip-text text-transparent bg-gradient-to-r from-purple-300 via-pink-300 to-amber-200">
                                University Day's Out 2026
                            </span>
                        </h1>
                        
                        <p class="text-white/80 text-xs md:text-sm italic font-light tracking-wide pt-1">
                            "Enlight The Future Through Education"
                        </p>
                    </div>
                </div>

                <!-- Divider -->
                <div class="h-px bg-gradient-to-r from-transparent via-white/30 to-transparent mx-6"></div>

                <!-- Form Section -->
                <div class="p-6">
                    <h2 class="text-white text-lg font-semibold mb-1">Daftar Pengunjung</h2>
                    <p class="text-white/40 text-sm mb-6">Isi data diri untuk mengikuti expo universitas</p>

                    <!-- Error Messages -->
                    @if ($errors->any())
                    <div class="mb-5 p-4 rounded-xl bg-red-500/20 border border-red-400/30 backdrop-blur">
                        <ul class="text-red-300 text-sm space-y-1">
                            @foreach ($errors->all() as $error)
                                <li class="flex items-start gap-2">
                                    <span class="mt-0.5">•</span>
                                    <span>{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Registration Form -->
                    <form id="registerForm" action="{{ route('visitor.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Nama Lengkap -->
                        <div>
                            <label class="block text-white/80 text-sm font-medium mb-2">
                                Nama Lengkap <span class="text-pink-400">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}"
                                required
                                placeholder="Masukkan nama lengkap"
                                class="w-full px-4 py-3.5 rounded-xl frosted-input text-white placeholder-white/30 outline-none transition-all duration-300 appearance-none"
                            >
                        </div>

                        <!-- Asal Sekolah -->
                        <div>
                            <label class="block text-white/80 text-sm font-medium mb-2">
                                Asal Sekolah <span class="text-pink-400">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="school_origin" 
                                value="{{ old('school_origin') }}"
                                required
                                placeholder="Contoh: SMAN 1 Jakarta"
                                class="w-full px-4 py-3.5 rounded-xl frosted-input text-white placeholder-white/30 outline-none transition-all duration-300 appearance-none"
                            >
                        </div>

                        <!-- No. WhatsApp -->
                        <div>
                            <label class="block text-white/80 text-sm font-medium mb-2">
                                No. WhatsApp <span class="text-pink-400">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40 text-sm">+62</span>
                                <input 
                                    type="number" 
                                    name="phone" 
                                    value="{{ old('phone') }}"
                                    required
                                    placeholder="81234567890"
                                    class="w-full pl-12 pr-4 py-3.5 rounded-xl frosted-input text-white placeholder-white/30 outline-none transition-all duration-300 appearance-none"
                                >
                            </div>
                        </div>

                        <!-- Jurusan Impian -->
                        <div>
                            <label class="block text-white/80 text-sm font-medium mb-2">
                                Jurusan Impian <span class="text-white/30 text-xs">(Opsional)</span>
                            </label>
                            <input 
                                type="text" 
                                name="dream_major" 
                                value="{{ old('dream_major') }}"
                                placeholder="Contoh: Teknik Informatika"
                                class="w-full px-4 py-3.5 rounded-xl frosted-input text-white placeholder-white/30 outline-none transition-all duration-300 appearance-none"
                            >
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit"
                            class="w-full py-4 mt-4 rounded-xl font-bold text-white bg-gradient-to-r from-purple-600 via-pink-500 to-amber-500 animate-gradient-btn hover:shadow-2xl hover:shadow-purple-500/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 flex items-center justify-center gap-2"
                        >
                            <span>Masuk Sekarang</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </form>
                </div>

                <!-- Footer -->
                <div class="px-8 pb-8 pt-2 text-center">
                    <p class="text-white/30 text-xs">
                        Dengan mendaftar, Anda menyetujui 
                        <a href="#" class="text-purple-400 hover:text-purple-300">Syarat & Ketentuan</a>
                    </p>
                </div>
            </div>

            <!-- Copyright -->
            <p class="text-center text-white/20 text-xs mt-8">© {{ date('Y') }} University Days Out</p>
        </main>
    </div>

    <!-- ==================== SPLASH SCREEN ==================== -->
    <div id="splash-screen" class="fixed inset-0 z-50 hidden bg-gradient-to-br from-[#0a0612] via-[#1a0d2e] to-[#0f0a1e]">
        
        <!-- Splash Blobs -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="blob-1 absolute top-[20%] left-[10%] w-[400px] h-[400px] rounded-full bg-purple-600/40 blur-3xl"></div>
            <div class="blob-2 absolute bottom-[10%] right-[10%] w-[500px] h-[500px] rounded-full bg-pink-600/30 blur-3xl"></div>
        </div>

        <!-- Animated Clouds -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Cloud 1 - Moving Left to Right -->
            <svg class="absolute top-[25%] animate-cloud-left w-[350px] h-[175px]" viewBox="0 0 200 100">
                <ellipse cx="40" cy="60" rx="35" ry="28" fill="rgba(255,255,255,0.2)"/>
                <ellipse cx="85" cy="48" rx="50" ry="38" fill="rgba(255,255,255,0.2)"/>
                <ellipse cx="140" cy="58" rx="45" ry="30" fill="rgba(255,255,255,0.2)"/>
                <ellipse cx="60" cy="35" rx="30" ry="22" fill="rgba(255,255,255,0.2)"/>
                <ellipse cx="110" cy="32" rx="35" ry-"24" fill="rgba(255,255,255,0.2)"/>
            </svg>

            <!-- Cloud 2 - Moving Right to Left -->
            <svg class="absolute top-[60%] animate-cloud-right w-[400px] h-[200px]" viewBox="0 0 200 100">
                <ellipse cx="50" cy="55" rx="42" ry="30" fill="rgba(255,255,255,0.15)"/>
                <ellipse cx="105" cy="48" rx="55" ry="40" fill="rgba(255,255,255,0.15)"/>
                <ellipse cx="160" cy="56" rx="40" ry="28" fill="rgba(255,255,255,0.15)"/>
            </svg>

            <!-- Cloud 3 - Slower -->
            <svg class="absolute top-[40%] animate-cloud-left w-[280px] h-[140px]" style="animation-duration: 16s; animation-delay: -5s;" viewBox="0 0 200 100">
                <ellipse cx="55" cy="58" rx="40" ry="28" fill="rgba(255,255,255,0.1)"/>
                <ellipse cx="100" cy="50" rx="48" ry="35" fill="rgba(255,255,255,0.1)"/>
                <ellipse cx="150" cy="56" rx="38" ry="26" fill="rgba(255,255,255,0.1)"/>
            </svg>
        </div>

        <!-- Centered Logo -->
        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <!-- Pulsing Logo -->
            <div class="animate-logo-pulse w-36 h-36 rounded-3xl bg-gradient-to-br from-purple-500 via-pink-500 to-amber-400 p-1">
                <div class="w-full h-full rounded-3xl bg-black/70 backdrop-blur flex items-center justify-center">
                    <x-application-logo class="w-20 h-20 text-white" />
                </div>
            </div>

            <!-- Loading Text -->
            <p class="mt-10 text-white/80 text-xl font-medium tracking-wide">Memproses pendaftaran...</p>

            <!-- Animated Dots -->
            <div class="flex gap-3 mt-6">
                <span class="w-3 h-3 rounded-full bg-purple-400 animate-bounce" style="animation-delay: 0ms;"></span>
                <span class="w-3 h-3 rounded-full bg-pink-400 animate-bounce" style="animation-delay: 200ms;"></span>
                <span class="w-3 h-3 rounded-full bg-amber-400 animate-bounce" style="animation-delay: 400ms;"></span>
            </div>
        </div>
    </div>

    <!-- ==================== SPLASH SCREEN SCRIPT ==================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const splashScreen = document.getElementById('splash-screen');

            if (form && splashScreen) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); // Stop immediate submit

                    // Show splash screen
                    splashScreen.classList.remove('hidden');
                    splashScreen.classList.add('flex');

                    // Add fade-in animation
                    splashScreen.style.animation = 'fade-in-up 0.4s ease-out forwards';

                    // Wait 2 seconds for animation, then submit
                    setTimeout(() => {
                        form.submit();
                    }, 2000);
                });
            }
        });
    </script>
</body>
</html>
