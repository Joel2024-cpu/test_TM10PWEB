@extends('layouts.app')

@section('title', $cabin->nama_cabin . ' - Bobocabin')

@section('head')
<script>
  function addToWishlist(cabinId) {
    fetch('{{ route("wishlist.add") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ cabin_id: cabinId })
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        const event = new CustomEvent('wishlistUpdated', { detail: data.wishlist_count });
        window.dispatchEvent(event);

        Swal.fire({
          title: 'Ditambahkan! 💖',
          text: data.message,
          icon: 'success',
          confirmButtonText: 'Oke',
          confirmButtonColor: '#3D6456'
        });
      }
    });
  }
</script>
@endsection

@section('content')
<div class="container mx-auto px-4 py-10">
  <a href="/" class="text-emerald-700 dark:text-green-300 hover:underline transition-colors">&larr; Kembali</a>

  <div class="mt-6 flex flex-col md:flex-row gap-8">
    <!-- Cabin Image -->
    <div class="w-full md:w-1/2">
      <img src="{{ $cabin->gambar }}" alt="{{ $cabin->nama_cabin }}"
           class="w-full rounded-2xl shadow-lg dark:shadow-gray-800 transition-all duration-300">

      <!-- ✅ SESSION: Wishlist Button -->
      <button onclick="addToWishlist({{ $cabin->id }})"
              class="mt-4 w-full bg-pink-500 text-white py-3 rounded-lg hover:bg-pink-600 transition-colors flex items-center justify-center gap-2">
        <i class="fas fa-heart"></i>
        Tambah ke Wishlist
      </button>
    </div>

    <!-- Cabin Details -->
    <div class="w-full md:w-1/2">
      <h1 class="text-4xl font-bold text-emerald-800 dark:text-green-300 mb-4">{{ $cabin->nama_cabin }}</h1>

      <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400 mb-4">
        <i class="fas fa-map-marker-alt"></i>
        <span>{{ $cabin->lokasi }}</span>
      </div>

      <div class="mb-6">
        <span class="text-2xl font-bold text-emerald-700 dark:text-green-400">
          Rp {{ number_format($cabin->harga_per_malam, 0, ',', '.') }} / malam
        </span>
      </div>

      <p class="text-gray-700 dark:text-gray-300 mb-8 leading-relaxed">
        Nikmati pengalaman glamping eksklusif di {{ $cabin->lokasi }}.
        {{ $cabin->nama_cabin }} menawarkan kenyamanan modern dengan sentuhan alam yang menenangkan.
        Perfect untuk retreat pribadi, honeymoon, atau quality time bersama keluarga. 🌲✨
      </p>

      <a href="/booking/{{ $cabin->id }}/create"
         class="block w-full bg-emerald-800 dark:bg-green-700 text-white text-center py-4 rounded-lg hover:bg-emerald-700 dark:hover:bg-green-600 transition-colors text-lg font-semibold">
        Pesan Sekarang 🌿
      </a>

      <!-- ✅ SESSION: Activity Info -->
      <div class="mt-8 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
        <h3 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">📊 Activity Info:</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400">
          @if(session('user_id'))
          Login sebagai: {{ session('user_role') }}<br>
          Site Visits: {{ session('site_visits', 0) }}
          @else
          Status: Guest user<br>
          Wishlist: {{ count(session('wishlist', [])) }} items
          @endif
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
