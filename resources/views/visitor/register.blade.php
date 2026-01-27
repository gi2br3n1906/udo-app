@extends('layouts.app')

@section('title', 'Registrasi Pengunjung')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang!</h1>
            <p class="text-gray-600">Silakan isi data diri Anda untuk melanjutkan kunjungan</p>
        </div>

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

            <!-- Class -->
            <div>
                <label for="class" class="block text-sm font-medium text-gray-700 mb-2">
                    Kelas <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       id="class"
                       name="class"
                       value="{{ old('class') }}"
                       required
                       placeholder="Contoh: XII IPA 1"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('class') border-red-500 @enderror">
                @error('class')
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
