@extends('layouts.app')

@section('title', 'Terima Kasih')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow-lg p-8 text-center">
        <!-- Success Icon -->
        <div class="mb-6">
            <div class="bg-green-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto">
                <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
        </div>

        <h1 class="text-3xl font-bold text-gray-900 mb-4">Terima Kasih!</h1>
        <p class="text-gray-600 mb-8">
            Registrasi Anda telah berhasil. Selamat menikmati acara UDO 2026!
        </p>

        <div class="space-y-4">
            <a href="{{ route('universities.index') }}"
               class="block w-full px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                Jelajahi Kampus
            </a>
            <a href="{{ route('umkm.index') }}"
               class="block w-full px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition">
                Lihat UMKM
            </a>
            <a href="{{ route('map.index') }}"
               class="block w-full px-6 py-3 bg-pink-600 text-white font-semibold rounded-lg hover:bg-pink-700 transition">
                Buka Peta Lokasi
            </a>
            <a href="{{ route('rundown.index') }}"
               class="block w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                Lihat Rundown Acara
            </a>
        </div>

        <div class="mt-8">
            <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:text-gray-700">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
