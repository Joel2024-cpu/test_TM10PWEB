@extends('layouts.app')

@section('title', 'Wishlist - Bobocabin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-bobogreen dark:text-green-300 mb-2">💖 Wishlist Saya</h1>
            <p class="text-gray-600 dark:text-gray-400">
                Cabin-cabin yang sudah Anda simpan untuk dipesan nanti
            </p>
        </div>

        <!-- ✅ SESSION: Wishlist Info -->
        <div class="bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-lg p-4 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-800 dark:text-blue-300 font-semibold">
                        💾 Data disimpan di SESSION
                    </p>
                    <p class="text-blue-600 dark:text-blue-400 text-sm">
                        Total: {{ count($cabins) }} cabin •
                        Akan hilang saat browser ditutup
                    </p>
                </div>
                <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm">
                    Session ID: {{ substr(session()->getId(), 0, 8) }}...
                </span>
            </div>
        </div>

        @if(count($cabins) > 0)
        <!-- Wishlist Items -->
        <div class="grid md:grid-cols-2 gap-6">
            @foreach($cabins as $cabin)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <img src="{{ $cabin->gambar }}" alt="{{ $cabin->nama_cabin }}"
                     class="w-full h-48 object-cover">

                <div class="p-4">
                    <h3 class="text-xl font-semibold text-bobogreen dark:text-green-300 mb-2">
                        {{ $cabin->nama_cabin }}
                    </h3>

                    <div class="flex items-center text-gray-600 dark:text-gray-400 mb-2">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        <span>{{ $cabin->lokasi }}</span>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <span class="text-lg font-bold text-emerald-700 dark:text-green-400">
                            Rp {{ number_format($cabin->harga_per_malam, 0, ',', '.') }} / malam
                        </span>
                    </div>

                    <div class="flex gap-2">
                        <a href="/cabins/{{ $cabin->id }}"
                           class="flex-1 bg-bobogreen text-white text-center py-2 rounded hover:bg-green-700 transition-colors">
                            Lihat Detail
                        </a>
                        <a href="/booking/{{ $cabin->id }}/create"
                           class="flex-1 bg-emerald-600 text-white text-center py-2 rounded hover:bg-emerald-700 transition-colors">
                            Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Empty Wishlist Action -->
        @else
        <div class="text-center py-12">
            <div class="w-24 h-24 mx-auto mb-4 text-gray-400">
                <i class="fas fa-heart text-6xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">
                Wishlist Masih Kosong
            </h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">
                Tambahkan cabin favorit Anda ke wishlist untuk menyimpannya sementara
            </p>
            <a href="/"
               class="inline-block bg-bobogreen text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors">
                🏕️ Jelajahi Cabin
            </a>
        </div>
        @endif

        <!-- ✅ SESSION: Demo Info -->
        <div class="mt-8 bg-gray-50 dark:bg-gray-800 rounded-lg p-6">
            <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-3">ℹ️ Demo Session Wishlist</h3>
            <div class="grid md:grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="font-medium text-gray-600 dark:text-gray-400">Karakteristik SESSION:</p>
                    <ul class="list-disc list-inside text-gray-500 dark:text-gray-400 mt-1 space-y-1">
                        <li>Data tersimpan di server</li>
                        <li>Browser hanya menyimpan Session ID</li>
                        <li>Data hilang ketika browser ditutup</li>
                        <li>Cocok untuk data sementara seperti wishlist</li>
                    </ul>
                </div>
                <div>
                    <p class="font-medium text-gray-600 dark:text-gray-400">Data Session:</p>
                    <div class="bg-white dark:bg-gray-700 p-3 rounded border text-xs font-mono mt-1">
                        <strong>wishlist:</strong> {{ count($cabins) }} items<br>
                        <strong>session_id:</strong> {{ session()->getId() }}<br>
                        <strong>user_role:</strong> {{ session('user_role', 'guest') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<script>
    Swal.fire({
        title: 'Berhasil! 🎉',
        text: '{{ session('success') }}',
        icon: 'success',
        confirmButtonText: 'Oke',
        confirmButtonColor: '#3D6456'
    });
</script>
@endif
@endsection
