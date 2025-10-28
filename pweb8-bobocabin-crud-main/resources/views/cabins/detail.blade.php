<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $cabin->nama_cabin }} - Bobocabin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
  <div class="container mx-auto px-4 py-10">
    <a href="/" class="text-emerald-700 hover:underline">&larr; Kembali</a>

    <div class="mt-6 flex flex-col md:flex-row gap-6">
      <img src="{{ $cabin->gambar }}" class="w-full md:w-1/2 rounded-2xl shadow">
      <div>
        <h1 class="text-3xl font-bold text-emerald-800 mb-2">{{ $cabin->nama_cabin }}</h1>
        <p class="text-gray-600 mb-2">{{ $cabin->lokasi }}</p>
        <p class="text-lg font-semibold text-emerald-700 mb-4">Rp {{ number_format($cabin->harga_per_malam, 0, ',', '.') }} / malam</p>

        <p class="text-gray-700 mb-6">
          Nikmati pengalaman unik menginap di {{ $cabin->lokasi }} dengan fasilitas modern dan suasana alam menenangkan 🌲✨.
        </p>

        <a href="/booking/{{ $cabin->id }}" class="bg-emerald-800 text-white px-6 py-3 rounded-lg hover:bg-emerald-700">Pesan Sekarang</a>
      </div>
    </div>
  </div>
</body>
</html>
