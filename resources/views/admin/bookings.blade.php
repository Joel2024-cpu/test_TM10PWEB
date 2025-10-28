<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Pemesanan - Admin Bobocabin</title>
  <script src="https://cdn.tailwindcss.com"></script>
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


  <nav class="bg-white shadow-md p-4 sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-extrabold text-bobogreen tracking-wide">BOBOCABIN ADMIN</h1>
      <a href="/" class="text-gray-700 hover:text-bobogreen transition">← Kembali ke Halaman Utama</a>
    </div>
  </nav>


  <div class="container mx-auto mt-12 bg-white p-8 rounded-2xl shadow-lg">
    <h2 class="text-3xl font-bold mb-8 text-center text-bobogreen">Daftar Pemesanan</h2>

    @if($bookings->isEmpty())
      <p class="text-center text-gray-500">Belum ada pemesanan.</p>
    @else
      <div class="overflow-x-auto">
        <table class="w-full border-collapse border border-gray-200 rounded-lg overflow-hidden">
          <thead class="bg-bobogreen text-white">
            <tr>
              <th class="p-3 border">No</th>
              <th class="p-3 border">Nama Pemesan</th>
              <th class="p-3 border">Email</th>
              <th class="p-3 border">Cabin</th>
              <th class="p-3 border">Check-In</th>
              <th class="p-3 border">Check-Out</th>
              <th class="p-3 border">Metode Pembayaran</th>
              <th class="p-3 border">Dibuat Pada</th>
            </tr>
          </thead>
          <tbody>
            @foreach($bookings as $b)
            <tr class="hover:bg-bobolight transition">
              <td class="p-3 border text-center font-semibold text-bobogreen">{{ $loop->iteration }}</td>
              <td class="p-3 border">{{ $b->nama_pemesan }}</td>
              <td class="p-3 border">{{ $b->email }}</td>
              <td class="p-3 border text-bobogreen font-medium">{{ $b->cabin->nama_cabin ?? '-' }}</td>
              <td class="p-3 border">{{ $b->check_in }}</td>
              <td class="p-3 border">{{ $b->check_out }}</td>
              <td class="p-3 border font-medium text-emerald-700">{{ $b->metode_pembayaran }}</td>
              <td class="p-3 border text-sm text-gray-500">{{ $b->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>


  <footer class="bg-bobogreen text-white mt-16 py-8">
    <div class="container mx-auto text-center">
      <p class="text-lg font-semibold">Bobocabin Admin Dashboard</p>
      <p class="text-gray-100 text-sm mt-1">
        © {{ date('Y') }} Bobocabin Indonesia · All Rights Reserved
      </p>
      <div class="flex justify-center space-x-4 mt-3">
        <a href="#" class="hover:text-yellow-400"><i class="fa-brands fa-instagram text-xl"></i></a>
        <a href="#" class="hover:text-yellow-400"><i class="fa-brands fa-facebook text-xl"></i></a>
        <a href="#" class="hover:text-yellow-400"><i class="fa-brands fa-twitter text-xl"></i></a>
      </div>
    </div>
  </footer>

  <script src="https://kit.fontawesome.com/4d44aa93c1.js" crossorigin="anonymous"></script>
</body>
</html>
