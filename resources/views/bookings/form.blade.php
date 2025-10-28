<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesan {{ $cabin->nama_cabin }} - Bobocabin</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

  <nav class="bg-white shadow p-4">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold text-bobogreen">bobocabin</h1>
      <a href="/cabin/{{ $cabin->id }}" class="text-gray-700 hover:text-bobogreen">← Kembali</a>
    </div>
  </nav>


  <div class="container mx-auto px-6 py-12">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-lg">
      <h2 class="text-3xl font-bold text-center text-bobogreen mb-6">Form Pemesanan</h2>

      <form id="bookingForm" action="/booking" method="POST" class="space-y-5">
        @csrf
        <input type="hidden" name="cabin_id" value="{{ $cabin->id }}">

        <div>
          <label class="block text-gray-700 mb-1">Nama Pemesan</label>
          <input type="text" name="nama_pemesan" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-bobogreen" required>
        </div>

        <div>
          <label class="block text-gray-700 mb-1">Email</label>
          <input type="email" name="email" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-bobogreen" required>
        </div>

        <div>
          <label class="block text-gray-700 mb-1">Metode Pembayaran</label>
          <select name="metode_pembayaran" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-bobogreen" required>
            <option value="">-- Pilih Metode Pembayaran --</option>
            <option value="Transfer Bank">Transfer Bank (BCA, Mandiri, BNI)</option>
            <option value="E-Wallet">E-Wallet (Dana, OVO, GoPay)</option>
            <option value="Kartu Kredit">Kartu Kredit</option>
            <option value="Bayar di Tempat">Bayar di Tempat</option>
          </select>
        </div>

        <div>
          <label class="block text-gray-700 mb-1">Tanggal Check-in</label>
          <input type="date" name="check_in" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-bobogreen" required>
        </div>

        <div>
          <label class="block text-gray-700 mb-1">Tanggal Check-out</label>
          <input type="date" name="check_out" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-bobogreen" required>
        </div>

        <button type="submit" class="w-full bg-bobogreen text-white py-2 rounded-lg hover:bg-emerald-800 transition">
          Konfirmasi Pemesanan
        </button>
      </form>
    </div>
  </div>


  <footer class="bg-bobogreen text-white py-6 text-center">
    <p>&copy; {{ date('Y') }} Bobocabin Indonesia · All Rights Reserved</p>
  </footer>


  @if(session('success'))
  <script>
    Swal.fire({
      title: 'Pemesanan Berhasil!',
      text: '{{ session("success") }}',
      icon: 'success',
      confirmButtonText: 'Kembali ke Beranda',
      confirmButtonColor: '#3D6456'
    }).then(() => {
      window.location.href = '/';
    });
  </script>
  @endif
</body>
</html>
