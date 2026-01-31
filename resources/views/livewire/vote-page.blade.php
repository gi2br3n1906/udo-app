<div class="min-h-screen bg-gradient-to-b from-pink-50 via-white to-white -mx-5 px-5">
    @if($hasVoted)
        {{-- THANK YOU STATE --}}
        <div class="px-4 py-8">
            <div class="bg-white rounded-3xl shadow-lg p-8 text-center max-w-md mx-auto border border-pink-100">
                {{-- Success Icon --}}
                <div class="w-20 h-20 bg-gradient-to-br from-pink-500 to-rose-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-pink-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <h2 class="text-xl font-bold text-slate-800 mb-2">Terima Kasih!</h2>
                <p class="text-slate-500 text-sm mb-6">Suaramu sudah tercatat.</p>

                @if($votedUniversity)
                    <div class="bg-pink-50 rounded-2xl p-4 mb-6">
                        <p class="text-xs text-pink-600 font-medium uppercase tracking-wide mb-2">Kamu memilih</p>
                        <div class="flex items-center justify-center gap-3">
                            @if($votedUniversity->logo_path)
                                <img src="{{ $votedUniversity->logo_url }}" alt="{{ $votedUniversity->name }}" class="h-12 w-12 object-contain">
                            @endif
                            <span class="font-bold text-slate-800">{{ $votedUniversity->name }}</span>
                        </div>
                    </div>
                @endif

                {{-- Top Voted Leaderboard --}}
                @if($topVoted->count() > 0)
                    <div class="text-left">
                        <h3 class="text-sm font-semibold text-slate-600 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Top 5 Sementara
                        </h3>
                        <div class="space-y-2">
                            @foreach($topVoted as $index => $uni)
                                <div class="flex items-center gap-3 p-2 rounded-lg {{ $votedUniversityId === $uni->id ? 'bg-pink-100' : 'bg-slate-50' }}">
                                    <span class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold
                                        {{ $index === 0 ? 'bg-yellow-400 text-yellow-900' : '' }}
                                        {{ $index === 1 ? 'bg-slate-300 text-slate-700' : '' }}
                                        {{ $index === 2 ? 'bg-amber-600 text-white' : '' }}
                                        {{ $index > 2 ? 'bg-slate-200 text-slate-600' : '' }}
                                    ">{{ $index + 1 }}</span>
                                    <span class="flex-1 text-sm font-medium text-slate-700 truncate">{{ $uni->name }}</span>
                                    <span class="text-xs text-slate-400">{{ $uni->votes_count }} vote</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 mt-6 text-sm text-pink-600 font-medium hover:text-pink-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    @else
        {{-- HEADER SECTION --}}
        <div class="mb-8 text-center pt-4">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-pink-100 text-pink-600 mb-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
            <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Vote Kampus Favorit</h2>
            <p class="text-gray-500 text-sm mt-1">Satu suara sangat berarti. Pilih dengan bijak!</p>
        </div>

        {{-- INTERACTIVE VOTING GRID --}}
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-3 md:gap-5 px-3 pb-20">
            @foreach($universities as $uni)
            <button 
                wire:click="vote({{ $uni->id }})" 
                wire:confirm="Yakin ingin memberikan suaramu untuk {{ $uni->name }}?"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-50 cursor-wait"
                class="group relative bg-white rounded-xl p-3 shadow-sm hover:shadow-lg hover:ring-2 hover:ring-pink-400 hover:-translate-y-1 active:scale-95 transition-all duration-200 border border-gray-100 flex flex-col items-center text-center h-full w-full"
            >
                {{-- Hover Checkmark --}}
                <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
                    <div class="w-5 h-5 rounded-full bg-pink-500 text-white flex items-center justify-center">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>

                {{-- Logo --}}
                <div class="w-20 h-20 md:w-24 md:h-24 bg-gray-50 rounded-full flex items-center justify-center p-3 mb-3 group-hover:bg-pink-50 transition-colors">
                    @if($uni->logo_path)
                        <img src="{{ $uni->logo_url }}" alt="{{ $uni->name }}" class="w-full h-full object-contain">
                    @else
                        <span class="text-2xl">🎓</span>
                    @endif
                </div>

                {{-- Name --}}
                <h3 class="text-xs md:text-sm font-bold text-gray-700 group-hover:text-pink-600 leading-snug line-clamp-2">
                    {{ $uni->name }}
                </h3>
                
                <span class="mt-2 text-[10px] text-gray-400 group-hover:text-pink-400">Ketuk untuk pilih</span>
            </button>
            @endforeach
        </div>

        @if($universities->isEmpty())
            <div class="text-center py-12">
                <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="font-semibold text-slate-600 mb-1">Belum Ada Kampus</h3>
                <p class="text-sm text-slate-400">Data kampus akan muncul di sini</p>
            </div>
        @endif
    @endif

    {{-- Loading Overlay --}}
    <div wire:loading.flex wire:target="vote" class="fixed inset-0 bg-black/50 items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-6 flex flex-col items-center gap-3">
            <div class="w-10 h-10 border-4 border-pink-200 border-t-pink-600 rounded-full animate-spin"></div>
            <span class="text-sm text-slate-600 font-medium">Menyimpan pilihan...</span>
        </div>
    </div>
</div>
