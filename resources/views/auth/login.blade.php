<!DOCTYPE html>
<html lang="id" class="@if(request()->cookie('theme') === 'dark') dark @endif">
<head>
  <meta charset="UTF-8">
  <title>Login - Bobocabin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-green-50 dark:bg-gray-900 flex items-center justify-center h-screen transition-colors duration-300">
  <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8 w-96 transition-colors duration-300">
    <h1 class="text-2xl font-bold text-center text-emerald-700 dark:text-green-300 mb-6">🌲 Login Bobocabin</h1>

    @if(session('error'))
    <div class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 p-3 rounded mb-4">
      {{ session('error') }}
    </div>
    @endif

    @if(session('info'))
    <div class="bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 p-3 rounded mb-4">
      {{ session('info') }}
    </div>
    @endif

    <form action="{{ route('login') }}" method="POST" class="space-y-4">
      @csrf

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Username</label>
        <input type="text" name="username" required
          class="w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded p-2 mt-1 focus:ring-emerald-700 focus:border-emerald-700 transition-colors">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
        <input type="password" name="password" required
          class="w-full border dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded p-2 mt-1 focus:ring-emerald-700 focus:border-emerald-700 transition-colors">
      </div>

      <!-- ✅ COOKIES: Remember Me -->
      <div class="flex items-center">
        <input type="checkbox" name="remember_me" id="remember_me" class="mr-2">
        <label for="remember_me" class="text-sm text-gray-600 dark:text-gray-400">Ingat saya</label>
      </div>

      <button type="submit"
        class="w-full bg-emerald-700 text-white py-2 rounded hover:bg-green-700 transition-colors">
        Login
      </button>
    </form>

    <!-- ✅ SESSION: Demo Info -->
    <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded text-sm">
        <p class="font-bold text-yellow-800 mb-2">🔐 Demo Accounts:</p>
        <div class="space-y-1 text-xs">
            <p><strong>Admin:</strong> admin / admin123</p>
            <p><strong>User:</strong> nazwa / nazwa123</p>
        </div>
    </div>

    <a href="/" class="block text-center text-sm text-emerald-700 dark:text-green-300 mt-4 hover:underline transition-colors">
      ← Kembali ke Beranda
    </a>
  </div>

  @if(session('success'))
  <script>
    Swal.fire({
      title: 'Login Berhasil! 🎉',
      text: '{{ session('success') }}',
      icon: 'success',
      confirmButtonText: 'Lanjutkan',
      confirmButtonColor: '#3D6456',
      background: '{{ request()->cookie("theme") === "dark" ? "#1a1a1a" : "#ffffff" }}',
      color: '{{ request()->cookie("theme") === "dark" ? "#ffffff" : "#000000" }}'
    }).then(() => {
      window.location.href = '/dashboard';
    });
  </script>
  @endif
</body>
</html>
