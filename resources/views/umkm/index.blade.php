@extends('layouts.app')

@section('title', 'Katalog UMKM')

@section('content')
<div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-4">Katalog UMKM</h1>
        <p class="text-xl text-purple-100">Temukan kuliner dan produk UMKM lokal terbaik</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($umkms->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($umkms as $umkm)
        <a href="{{ route('umkm.show', $umkm) }}"
           class="bg-white rounded-lg shadow-md hover:shadow-xl transition p-6">
            <div class="mb-4">
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $umkm->name }}</h3>
                @if($umkm->price_range)
                <div class="text-sm text-green-600 font-semibold mb-2">
                    💰 {{ $umkm->price_range }}
                </div>
                @endif
                <p class="text-gray-600 text-sm line-clamp-3">
                    {{ $umkm->description }}
                </p>
            </div>

            @if($umkm->menu_list && count($umkm->menu_list) > 0)
            <div class="border-t pt-4">
                <h4 class="text-sm font-semibold text-gray-700 mb-2">Menu Populer:</h4>
                <ul class="text-sm text-gray-600 space-y-1">
                    @foreach(array_slice($umkm->menu_list, 0, 3) as $menu)
                    <li>• {{ $menu['item'] ?? $menu }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if($umkm->map_booth_id)
            <div class="mt-4 text-sm text-purple-600 font-semibold">
                📍 Booth {{ $umkm->map_booth_id }}
            </div>
            @endif
        </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $umkms->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <p class="text-gray-500 text-lg">Belum ada UMKM yang terdaftar.</p>
    </div>
    @endif
</div>
@endsection
