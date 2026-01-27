@extends('layouts.app')

@section('title', 'Katalog Universitas')

@section('content')
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-4">Katalog Universitas</h1>
        <p class="text-xl text-indigo-100">Jelajahi berbagai universitas yang berpartisipasi dalam UDO 2026</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($universities->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($universities as $university)
        <div class="relative group" x-data="{ 
            isLiked: {{ $university->is_favorited_by_auth_user ? 'true' : 'false' }}, 
            isLoading: false,
            toggleFavorite() {
                if(this.isLoading) return;
                this.isLoading = true;
                
                // Optimistic UI update
                this.isLiked = !this.isLiked;

                fetch('{{ route('universities.toggle-favorite', $university->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content')
                    }
                })
                .then(res => {
                    if (!res.ok) throw new Error('Network response was not ok');
                    return res.json();
                })
                .then(data => {
                    if(data.success) {
                        this.isLiked = (data.status === 'attached');
                    } else {
                        // Revert on failure
                        this.isLiked = !this.isLiked;
                    }
                }) // end then data
                .catch(error => {
                    console.error('Error:', error);
                    // Revert on error
                    this.isLiked = !this.isLiked;
                })
                .finally(() => {
                    this.isLoading = false;
                });
            }
        }">
            <!-- Favorite Heart Button -->
            <button type="button"
                    @click.stop.prevent="toggleFavorite()"
                    class="absolute top-3 right-3 z-30 p-2 rounded-full bg-white/90 hover:bg-white shadow-sm hover:shadow transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    :class="{ 'opacity-70 cursor-not-allowed': isLoading }">
               <svg xmlns="http://www.w3.org/2000/svg" 
                    class="h-6 w-6 transition-colors duration-300"
                    :class="isLiked ? 'text-red-500 fill-current' : 'text-gray-400'"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                       d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
               </svg>
            </button>

            <a href="{{ route('universities.show', $university->slug) }}" class="block h-full bg-white rounded-lg shadow-md hover:shadow-xl transition overflow-hidden">
                <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                    <img src="{{ $university->logo_url }}"
                         alt="{{ $university->name }}"
                         class="object-contain w-full h-48 p-4">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $university->name }}</h3>
                    <p class="text-gray-600 text-sm line-clamp-3">
                        {{ $university->description }}
                    </p>
                    @if($university->map_booth_id)
                    <div class="mt-4 text-sm text-indigo-600 font-semibold">
                        📍 Booth {{ $university->map_booth_id }}
                    </div>
                    @endif
                </div>
            </a>
        </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $universities->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <p class="text-gray-500 text-lg">Belum ada universitas yang terdaftar.</p>
    </div>
    @endif
</div>
@endsection
