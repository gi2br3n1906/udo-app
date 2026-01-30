@extends('layouts.app')

@section('title', 'Registrasi Pengunjung')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang!</h1>
            <p class="text-gray-600">Silakan isi data diri Anda untuk melanjutkan kunjungan</p>
        </div>

        {{-- Global Error Alert --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg text-sm">
                <div class="flex items-center gap-2 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <span class="font-semibold">Oops! Ada yang perlu diperbaiki:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 ml-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('visitor.store') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- School Origin -->
            <div>
                <label for="school_origin" class="block text-sm font-medium text-gray-700 mb-2">
                    Asal Sekolah <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       id="school_origin"
                       name="school_origin"
                       value="{{ old('school_origin') }}"
                       required
                       placeholder="Contoh: SMA Negeri 1 Semarang"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('school_origin') border-red-500 @enderror">
                @error('school_origin')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone (WhatsApp) -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                    No. WhatsApp <span class="text-red-500">*</span>
                </label>
                <p class="text-xs text-gray-500 mb-2">Wajib untuk info doorprize/beasiswa</p>
                <input type="text"
                       id="phone"
                       name="phone"
                       value="{{ old('phone') }}"
                       required
                       inputmode="numeric"
                       pattern="[0-9]*"
                       placeholder="Contoh: 081234567890"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dream Major -->
            <div>
                <label for="dream_major" class="block text-sm font-medium text-gray-700 mb-2">
                    Jurusan Impian <span class="text-gray-400">(Opsional)</span>
                </label>
                <input type="text"
                       id="dream_major"
                       name="dream_major"
                       value="{{ old('dream_major') }}"
                       placeholder="Contoh: Teknik Informatika"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('dream_major') border-red-500 @enderror">
                @error('dream_major')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                        class="w-full px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
                    Daftar Sekarang
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('home') }}" class="text-sm text-indigo-600 hover:text-indigo-700">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
