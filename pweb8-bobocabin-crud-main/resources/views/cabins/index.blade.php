<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bobocabin Indonesia</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome (versi terbaru yang dijamin aktif) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            bobogreen: '#3D6456',
            bobolight: '#E8F1EC',
            bobocream: '#F9F9F7'
          }
        }
      }
    }
  </script>
</head>

<body class="bg-bobocream text-gray-800">

  <!-- Navbar -->
  <nav class="bg-white shadow p-4 sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-extrabold text-bobogreen tracking-wide">bobocabin</h1>
      <ul class="flex space-x-6">
        <li><a href="/" class="text-gray-700 hover:text-bobogreen font-medium">Home</a></li>
        <li><a href="#cabin-section" class="text-gray-700 hover:text-bobogreen font-medium">Cabin</a></li>
        <li><a href="/admin" class="text-gray-700 hover:text-bobogreen font-medium">Admin</a></li>
      </ul>
    </div>
  </nav>


  <section class="relative h-[75vh] bg-cover bg-center flex items-center justify-center"
    style="background-image: url('https://dynamic-media-cdn.tripadvisor.com/media/photo-o/25/23/02/52/bobocabin-cikole.jpg?w=900&h=500&s=1');">
    <div class="absolute inset-0 bg-bobogreen opacity-50"></div>
    <div class="relative z-10 text-center px-6">
      <h2 class="text-white text-5xl font-extrabold mb-4">Temukan Ketentraman di Alam 🌿</h2>
      <p class="text-gray-100 text-lg max-w-2xl mx-auto">
        Rasakan pengalaman glamping modern yang berpadu dengan ketenangan alam Indonesia.  
        Nikmati suasana hutan, danau, dan pegunungan dengan kenyamanan Bobocabin.
      </p>
    </div>
  </section>


  <div id="cabin-section" class="container mx-auto px-6 py-16">
    <h2 class="text-3xl font-bold mb-10 text-center text-bobogreen">Cabin Pilihan Kami</h2>

    <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-10">
      @foreach($cabins as $cabin)
      <div class="bg-white rounded-2xl shadow hover:shadow-xl overflow-hidden transition">
        <img src="{{ $cabin->gambar }}" alt="{{ $cabin->nama_cabin }}" class="w-full h-56 object-cover">
        <div class="p-6">
          <h3 class="text-xl font-semibold text-bobogreen mb-1">{{ $cabin->nama_cabin }}</h3>
          <p class="text-gray-500 mb-2"><i class="fa-solid fa-location-dot text-bobogreen"></i> {{ $cabin->lokasi }}</p>
          <p class="text-lg font-bold text-emerald-700 mb-4">
            Rp {{ number_format($cabin->harga_per_malam, 0, ',', '.') }} / malam
          </p>
          <a href="/cabin/{{ $cabin->id }}" 
             class="block text-center bg-bobogreen text-white py-2 rounded-lg hover:bg-emerald-800 transition">
            Lihat Detail
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>


<footer class="bg-bobogreen text-white mt-16 pt-10">
  <div class="container mx-auto grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-10 px-6">


    <div>
      <h3 class="text-2xl font-semibold mb-3">bobocabin</h3>
      <p class="text-gray-100 text-sm leading-relaxed">
        Rasakan ketenangan alam dengan kenyamanan modern.  
        Bobocabin hadir untuk menemani perjalanan healing-mu di tengah keindahan Indonesia.
      </p>
    </div>


    <div>
      <h4 class="text-lg font-semibold mb-3">Hubungi Kami</h4>
      <ul class="space-y-2 text-gray-100 text-sm">
        <li>📍 Jl. Kebahagiaan No. 45, Bandung</li>
        <li>📞 0812-3456-7890</li>
        <li>✉️ support@bobocabin.co.id</li>
      </ul>
    </div>


    <div>
      <h4 class="text-lg font-semibold mb-3">Ikuti Kami</h4>
      <div class="flex space-x-5 mt-2">
        <a href="https://www.instagram.com/boboboxindonesia/" target="_blank" class="hover:text-yellow-400 transition transform hover:scale-110">
          <i class="fa-brands fa-instagram text-2xl"></i>
        </a>
        <a href="https://www.facebook.com/boboboxindonesia/" target="_blank" class="hover:text-yellow-400 transition transform hover:scale-110">
          <i class="fa-brands fa-facebook text-2xl"></i>
        </a>
        <a href="https://x.com/boboboxindonesia" target="_blank" class="hover:text-yellow-400 transition transform hover:scale-110">
          <i class="fa-brands fa-x-twitter text-2xl"></i>
        </a>
        <a href="https://www.youtube.com/@boboboxindonesia" target="_blank" class="hover:text-yellow-400 transition transform hover:scale-110">
          <i class="fa-brands fa-youtube text-2xl"></i>
        </a>
      </div>
    </div>
  </div>


  <div class="mt-10 border-t border-emerald-700 pt-4 text-center text-gray-100 text-sm">
    © {{ date('Y') }} <strong>Bobocabin Indonesia</strong> · All Rights Reserved
  </div>
</footer>
</body>
</html>
