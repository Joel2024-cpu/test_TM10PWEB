<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Cabin - Bobocabin Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">

  <nav class="bg-white shadow-md mb-8 p-4 sticky top-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-extrabold text-emerald-800 tracking-wide">
        BOBOCABIN ADMIN
      </h1>
      <ul class="flex space-x-6">
        <li><a href="/admin/orm" class="text-gray-700 hover:text-green-700 font-medium">Kelola Cabin</a></li>
        <li><a href="/admin/bookings" class="text-gray-700 hover:text-green-700 font-medium">Data Booking</a></li>
        <li><a href="/" class="text-gray-700 hover:text-green-700 font-medium">Kembali ke Beranda</a></li>
      </ul>
    </div>
  </nav>

  <h1 class="text-3xl font-bold text-emerald-800 mb-4">
    Kelola Cabin
  </h1>

  @if(session('success'))
    <div class="bg-green-100 text-emerald-800 p-3 mb-4 rounded">{{ session('success') }}</div>
  @endif

  <form id="cabinForm" action="{{ url()->current() }}" method="POST" class="mb-6 flex flex-wrap gap-2">
    @csrf
    <input type="hidden" name="_method" id="formMethod" value="POST">
    <input type="hidden" name="id" id="editId">

    <input type="text" name="nama_cabin" id="nama_cabin" placeholder="Nama Cabin" class="border p-2 rounded" required>
    <input type="text" name="lokasi" id="lokasi" placeholder="Lokasi" class="border p-2 rounded" required>
    <input type="number" name="harga_per_malam" id="harga_per_malam" placeholder="Harga per malam" class="border p-2 rounded" required>
    <input type="text" name="gambar" id="gambar" placeholder="URL Gambar" class="border p-2 rounded" required>

    <button id="submitButton" class="bg-emerald-700 text-white px-4 py-2 rounded hover:bg-green-800">
      Tambah
    </button>
    <button type="button" id="cancelEdit" class="hidden bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
      Batal
    </button>
  </form>

  <table class="w-full border-collapse border border-gray-300">
    <thead class="bg-emerald-700 text-white">
      <tr>
        <th class="p-2 border">ID</th>
        <th class="p-2 border">Nama Cabin</th>
        <th class="p-2 border">Lokasi</th>
        <th class="p-2 border">Harga</th>
        <th class="p-2 border">Jumlah Booking</th>
        <th class="p-2 border">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($cabins as $c)
      <tr class="border hover:bg-green-50">
        <td class="p-2 border text-center">{{ $c->id }}</td>
        <td class="p-2 border">{{ $c->nama_cabin }}</td>
        <td class="p-2 border">{{ $c->lokasi }}</td>
        <td class="p-2 border text-right">Rp {{ number_format($c->harga_per_malam, 0, ',', '.') }}</td>
        <td class="p-2 border text-center">{{ $c->bookings->count() }}</td>
        <td class="p-2 border text-center space-x-2">
          <button 
            onclick="editCabin({{ $c->id }}, '{{ $c->nama_cabin }}', '{{ $c->lokasi }}', '{{ $c->harga_per_malam }}', '{{ $c->gambar }}')" 
            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
            Edit
          </button>
          <form action="{{ url()->current() . '/' . $c->id }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')" class="inline">
            @csrf
            @method('DELETE')
            <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">Hapus</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="6" class="text-center p-4 text-gray-500">Belum ada data cabin</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  <script>
    const form = document.getElementById('cabinForm');
    const methodInput = document.getElementById('formMethod');
    const submitButton = document.getElementById('submitButton');
    const cancelButton = document.getElementById('cancelEdit');
    const editId = document.getElementById('editId');

    function editCabin(id, nama, lokasi, harga, gambar) {
      document.getElementById('nama_cabin').value = nama;
      document.getElementById('lokasi').value = lokasi;
      document.getElementById('harga_per_malam').value = harga;
      document.getElementById('gambar').value = gambar;

      form.action = `${window.location.pathname}/${id}`;
      methodInput.value = 'PUT';
      editId.value = id;

      submitButton.textContent = 'Update';
      submitButton.classList.replace('bg-emerald-700', 'bg-blue-700');
      submitButton.classList.replace('hover:bg-green-800', 'hover:bg-blue-800');

      cancelButton.classList.remove('hidden');
    }

    cancelButton.addEventListener('click', () => {
      form.action = window.location.pathname;
      methodInput.value = 'POST';
      editId.value = '';

      form.reset();

      submitButton.textContent = 'Tambah';
      submitButton.classList.replace('bg-blue-700', 'bg-emerald-700');
      submitButton.classList.replace('hover:bg-blue-800', 'hover:bg-green-800');

      cancelButton.classList.add('hidden');
    });
  </script>

</body>
</html>