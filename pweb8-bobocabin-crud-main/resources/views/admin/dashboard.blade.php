<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Bobocabin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">


  <nav class="bg-white shadow-md mb-8 p-4 sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-extrabold text-green-800 tracking-wide">
        BOBOCABIN ADMIN DASHBOARD
      </h1>
      <ul class="flex space-x-6">
        <li><a href="/admin/orm" class="text-gray-700 hover:text-green-700 font-medium">CRUD Cabin</a></li>
        <li><a href="/admin/bookings" class="text-gray-700 hover:text-green-700 font-medium">Data Booking</a></li>
        <li><a href="/" class="text-gray-700 hover:text-green-700 font-medium">Kembali ke Beranda</a></li>
      </ul>
    </div>
  </nav>


  <div class="container mx-auto text-center mt-16">
    <h2 class="text-4xl font-bold text-green-800 mb-6">Selamat Datang di Dashboard Admin 🌿</h2>
    <p class="text-gray-600 text-lg mb-10 max-w-2xl mx-auto">
      Dari sini kamu bisa mengelola data <strong>Cabin</strong> menggunakan tiga metode CRUD  
      (DB Helper, Query Builder, dan ORM Eloquent),  
      serta melihat <strong>Data Booking</strong> dari pelanggan.
    </p>

    <div class="grid md:grid-cols-2 gap-10 mt-10">
      <a href="/admin/orm" class="bg-green-700 text-white p-8 rounded-2xl shadow-lg hover:bg-green-800 transition">
        <h3 class="text-2xl font-bold mb-2">Kelola Data Cabin</h3>
        <p>CRUD menggunakan DB Helper, Query Builder, dan ORM (Eloquent)</p>
      </a>

      <a href="/admin/bookings" class="bg-emerald-600 text-white p-8 rounded-2xl shadow-lg hover:bg-emerald-700 transition">
        <h3 class="text-2xl font-bold mb-2">Lihat Data Booking</h3>
        <p>Menampilkan daftar pemesanan pelanggan</p>
      </a>
    </div>
  </div>

  
  <footer class="bg-green-800 text-white mt-16 py-6 text-center">
    <p>© {{ date('Y') }} Bobocabin Indonesia · All Rights Reserved</p>
  </footer>
</body>
</html>
