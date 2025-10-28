@extends('layouts.app')

@section('title', 'Dashboard - Bobocabin')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                Selamat datang kembali, {{ auth()->user()->username }}
            </p>
        </div>

        <!-- Stats Cards -->
        <!-- Activity Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Page Views -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-eye text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Page Views</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                            {{ session('user_activity.page_views', 0) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Cabin Views -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-home text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Cabin Views</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                            {{ count(session('user_activity.cabin_views', [])) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Booking Attempts -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-calendar-check text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Booking Attempts</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                            {{ session('user_activity.booking_attempts', 0) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Session Duration -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-orange-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-clock text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Session Duration</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">
                            @php
                                $loginTime = \Carbon\Carbon::parse(session('user_data.login_time'));
                                $duration = $loginTime->diffForHumans(now(), true);
                            @endphp
                            {{ $duration }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

            <!-- Wishlist Items -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-pink-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-heart text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Wishlist</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-white">
                            {{ count(session('wishlist', [])) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- User Role -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Role</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white capitalize">
                            {{ session('user_role') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Session Status -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                            <i class="fas fa-database text-white text-sm"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Session</p>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">Active</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left Column - User Actions -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Quick Actions -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Quick Actions</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-4">
                            <a href="/" class="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <div class="w-10 h-10 bg-bobogreen rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-search text-white"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">Cari Cabin</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Temukan penginapan</p>
                                </div>
                            </a>

                            <a href="/wishlist" class="flex items-center p-4 border border-gray-200 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <div class="w-10 h-10 bg-pink-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-heart text-white"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">Wishlist</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Cabin favorit</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Features (Subtle Implementation Showcase) -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">System Features</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <!-- Cookies Feature -->
                            <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-cookie-bite text-blue-500 mr-3"></i>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">Personalization</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Preferensi tersimpan aman</p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-200 rounded-full">
                                    Cookies
                                </span>
                            </div>

                            <!-- Session Feature -->
                            <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-green-500 mr-3"></i>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">Temporary Storage</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Data aktivitas sementara</p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs bg-green-100 dark:bg-green-800 text-green-800 dark:text-green-200 rounded-full">
                                    Session
                                </span>
                            </div>

                            <!-- Authorization Feature -->
                            <div class="flex items-center justify-between p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-shield-alt text-purple-500 mr-3"></i>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">Access Control</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Hak akses terkelola</p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 text-xs bg-purple-100 dark:bg-purple-800 text-purple-800 dark:text-purple-200 rounded-full">
                                    Authorization
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - User Info & Preferences -->
            <div class="space-y-6">

                <!-- User Profile Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Profile</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-bobogreen rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="ml-4">
                                <p class="font-medium text-gray-900 dark:text-white">{{ auth()->user()->username }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400 capitalize">{{ session('user_role') }}</p>
                            </div>
                        </div>

                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Login Time:</span>
                                <span class="text-gray-900 dark:text-white">{{ session('login_time') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Session ID:</span>
                                <span class="text-gray-900 dark:text-white font-mono text-xs">{{ substr(session()->getId(), 0, 8) }}...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Preferences Card -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Preferences</h3>
                    </div>
                    <div class="p-6">
                        @php
                            $prefs = json_decode(request()->cookie('bobocabin_prefs'), true) ?? [];
                        @endphp
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Theme</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white capitalize">
                                    {{ $prefs['theme'] ?? 'light' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Currency</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $prefs['currency'] ?? 'IDR' }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500 dark:text-gray-400">Language</span>
                                <span class="text-sm font-medium text-gray-900 dark:text-white capitalize">
                                    {{ $prefs['language'] ?? 'id' }}
                                </span>
                            </div>
                        </div>
                        <button onclick="showPreferences()" class="w-full mt-4 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 py-2 px-4 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-sm">
                            Manage Preferences
                        </button>
                    </div>
                </div>

                <!-- Admin Quick Access -->
                @if(session('user_role') === 'admin')
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Admin Panel</h3>
                    </div>
                    <div class="p-6">
                        <a href="/admin/bookings" class="block w-full bg-bobogreen text-white py-2 px-4 rounded-lg hover:bg-green-700 transition-colors text-center">
                            View Bookings
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
