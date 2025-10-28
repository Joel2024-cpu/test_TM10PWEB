<!DOCTYPE html>
<html lang="id" class="@if(request()->cookie('theme') === 'dark') dark @endif">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Bobocabin - Glamping Experience')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            bobogreen: '#3D6456',
            bobolight: '#E8F1EC',
            bobocream: '#F9F9F7',
            bododark: '#1a1a1a'
          }
        }
      }
    }

    // ✅ COOKIES: Load user preferences
    document.addEventListener('DOMContentLoaded', function() {
      const prefs = getCookie('bobocabin_prefs');
      if (prefs) {
        const preferences = JSON.parse(prefs);
        if (preferences.theme === 'dark') {
          document.documentElement.classList.add('dark');
        }
        window.userCurrency = preferences.currency || 'IDR';
      }

      // ✅ SESSION: Show session info untuk admin
      @if(session('user_role') === 'admin')
      console.log('Session Data:', {
        role: '{{ session("user_role") }}',
        visits: {{ session("site_visits", 0) }},
        loginTime: '{{ session("login_time") }}'
      });
      @endif
    });

    function getCookie(name) {
      const value = `; ${document.cookie}`;
      const parts = value.split(`; ${name}=`);
      if (parts.length === 2) return parts.pop().split(';').shift();
    }

    // ✅ COOKIES: Theme Toggle
    function toggleTheme() {
      const isDark = document.documentElement.classList.toggle('dark');
      updateThemeCookie(isDark ? 'dark' : 'light');
    }

    function updateThemeCookie(theme) {
      const prefs = getCookie('bobocabin_prefs');
      const preferences = prefs ? JSON.parse(prefs) : {};
      preferences.theme = theme;
      document.cookie = `bobocabin_prefs=${JSON.stringify(preferences)}; path=/; max-age=${60*60*24*30}`;
    }

    // ✅ COOKIES: Preferences Modal
    function showPreferences() {
      document.getElementById('preferencesModal').classList.remove('hidden');
    }

    function hidePreferences() {
      document.getElementById('preferencesModal').classList.add('hidden');
    }

    // ✅ SESSION: Add to Wishlist
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
            title: 'Berhasil! 💖',
            text: data.message,
            icon: 'success',
            confirmButtonText: 'Oke',
            confirmButtonColor: '#3D6456',
            background: '{{ request()->cookie("theme") === "dark" ? "#1a1a1a" : "#ffffff" }}',
            color: '{{ request()->cookie("theme") === "dark" ? "#ffffff" : "#000000" }}'
          });
        }
      });
    }

    // Listen for wishlist updates
    window.addEventListener('wishlistUpdated', function(event) {
      // Update wishlist counter UI
      const wishlistCount = event.detail;
      const counter = document.querySelector('.wishlist-counter');
      if (counter) {
        counter.textContent = wishlistCount;
        counter.classList.toggle('hidden', wishlistCount === 0);
      }
    });
  </script>

  @yield('head')
</head>
<body class="bg-bobocream dark:bg-bododark text-gray-800 dark:text-gray-200 transition-colors duration-300">

  <!-- Navigation -->
  <nav class="bg-white dark:bg-gray-800 shadow-md p-4 sticky top-0 z-50 transition-colors duration-300">
    <div class="container mx-auto flex justify-between items-center">
      <a href="/" class="text-2xl font-extrabold text-bobogreen dark:text-green-300 tracking-wide">
        🌲 BOBOCABIN
      </a>

      <div class="flex items-center space-x-6">
        <!-- ✅ COOKIES: Theme Toggle -->
        <button onclick="toggleTheme()" class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
          <i class="fas fa-moon dark:hidden"></i>
          <i class="fas fa-sun hidden dark:block"></i>
        </button>

        <!-- ✅ SESSION: User Info & Navigation -->
        @if(session('user_id'))
        <div class="flex items-center space-x-3">
          <!-- Dashboard Link -->
          <a href="{{ route('dashboard') }}" class="text-sm text-bobogreen dark:text-green-300 hover:underline">
            Dashboard
          </a>

          <!-- User Role Badge -->
          <span class="text-sm bg-bobogreen text-white px-3 py-1 rounded-full">
            {{ session('user_role') }} • Visits: {{ session('site_visits', 0) }}
          </span>

          <!-- Logout -->
          <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-sm bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition-colors">
              Logout
            </button>
          </form>
        </div>
        @else
        <a href="/login" class="text-bobogreen dark:text-green-300 hover:underline">Login</a>
        @endif

        <!-- ✅ SESSION: Wishlist Counter -->
        @php
          $wishlistCount = count(session('wishlist', []));
        @endphp
        <a href="{{ route('wishlist') }}" class="relative text-bobogreen dark:text-green-300 hover:text-pink-500 transition-colors">
          <i class="fas fa-heart text-xl"></i>
          @if($wishlistCount > 0)
          <span class="wishlist-counter absolute -top-2 -right-2 bg-pink-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
            {{ $wishlistCount }}
          </span>
          @endif
        </a>
      </div>
    </div>
  </nav>

  <!-- ✅ COOKIES: Preferences Panel -->
  <div class="bg-bobolight dark:bg-gray-700 border-b border-green-200 dark:border-gray-600 py-2">
    <div class="container mx-auto px-4">
      <div class="flex justify-between items-center text-sm">
        <span class="text-bobogreen dark:text-green-300">
          🎛️ Preferensi:
          @php
            $prefs = json_decode(request()->cookie('bobocabin_prefs', '{}'), true);
          @endphp
          {{ $prefs['currency'] ?? 'IDR' }} •
          {{ $prefs['language'] ?? 'ID' }} •
          {{ $prefs['theme'] ?? 'light' }}
        </span>
        <button onclick="showPreferences()" class="text-bobogreen dark:text-green-300 hover:underline text-xs">
          Ubah Preferensi
        </button>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="min-h-screen">
    @yield('content')
  </main>

  <!-- Flash Messages -->
  @if(session('success'))
  <script>
    Swal.fire({
      title: 'Berhasil! 🎉',
      text: '{{ session('success') }}',
      icon: 'success',
      confirmButtonText: 'Oke',
      confirmButtonColor: '#3D6456',
      background: '{{ request()->cookie("theme") === "dark" ? "#1a1a1a" : "#ffffff" }}',
      color: '{{ request()->cookie("theme") === "dark" ? "#ffffff" : "#000000" }}'
    });
  </script>
  @endif

  @if(session('error'))
  <script>
    Swal.fire({
      title: 'Oops! 😅',
      text: '{{ session('error') }}',
      icon: 'error',
      confirmButtonText: 'Mengerti',
      background: '{{ request()->cookie("theme") === "dark" ? "#1a1a1a" : "#ffffff" }}',
      color: '{{ request()->cookie("theme") === "dark" ? "#ffffff" : "#000000" }}'
    });
  </script>
  @endif

  <!-- Footer -->
  <footer class="bg-bobogreen dark:bg-gray-900 text-white py-8 mt-12 transition-colors duration-300">
    <div class="container mx-auto text-center">
      <p class="text-lg font-semibold">Bobocabin Indonesia 🌿</p>
      <p class="text-gray-100 dark:text-gray-300 text-sm mt-1">
        © {{ date('Y') }} Bobocabin · All Rights Reserved
      </p>
      <div class="flex justify-center space-x-4 mt-3">
        <a href="#" class="hover:text-yellow-400 transition-colors"><i class="fab fa-instagram text-xl"></i></a>
        <a href="#" class="hover:text-yellow-400 transition-colors"><i class="fab fa-facebook text-xl"></i></a>
        <a href="#" class="hover:text-yellow-400 transition-colors"><i class="fab fa-twitter text-xl"></i></a>
      </div>
    </div>
  </footer>

  <!-- ✅ COOKIES: Preferences Modal -->
  <div id="preferencesModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-96">
      <h3 class="text-xl font-bold mb-4 text-bobogreen dark:text-green-300">🎛️ Preferensi Pengguna</h3>
      <form action="{{ route('preferences.set') }}" method="POST">
        @csrf
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium mb-1">Tema</label>
            <select name="theme" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600">
              <option value="light" {{ ($prefs['theme'] ?? 'light') == 'light' ? 'selected' : '' }}>Light</option>
              <option value="dark" {{ ($prefs['theme'] ?? 'light') == 'dark' ? 'selected' : '' }}>Dark</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Mata Uang</label>
            <select name="currency" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600">
              <option value="IDR" {{ ($prefs['currency'] ?? 'IDR') == 'IDR' ? 'selected' : '' }}>IDR - Rupiah</option>
              <option value="USD" {{ ($prefs['currency'] ?? 'IDR') == 'USD' ? 'selected' : '' }}>USD - Dollar</option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium mb-1">Bahasa</label>
            <select name="language" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:border-gray-600">
              <option value="id" {{ ($prefs['language'] ?? 'id') == 'id' ? 'selected' : '' }}>Indonesia</option>
              <option value="en" {{ ($prefs['language'] ?? 'id') == 'en' ? 'selected' : '' }}>English</option>
            </select>
          </div>
        </div>
        <div class="flex gap-2 mt-6">
          <button type="submit" class="flex-1 bg-bobogreen text-white py-2 rounded hover:bg-green-700 transition-colors">
            Simpan
          </button>
          <button type="button" onclick="hidePreferences()" class="flex-1 bg-gray-500 text-white py-2 rounded hover:bg-gray-600 transition-colors">
            Batal
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
