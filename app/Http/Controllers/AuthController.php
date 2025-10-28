<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // ✅ COOKIES: Cek preferensi tema
        $theme = request()->cookie('theme', 'light');
        return view('auth.login', compact('theme'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            // ✅ PROFESSIONAL SESSION DATA
            Session::put('user_data', [
                'id' => $user->id,
                'username' => $user->username,
                'role' => $user->role,
                'login_time' => now()->toDateTimeString(),
                'last_activity' => now()->toDateTimeString(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);

            // ✅ USER ACTIVITY SESSION
            Session::put('user_activity', [
                'page_views' => 1,
                'cabin_views' => [],
                'search_queries' => [],
                'wishlist_items' => [],
                'booking_attempts' => 0
            ]);

            // ✅ PREFERENCES SESSION (fallback dari cookies)
            Session::put('user_preferences', [
                'currency' => $request->cookie('currency', 'IDR'),
                'language' => $request->cookie('language', 'id'),
                'notifications' => true,
                'marketing_emails' => false
            ]);

            return redirect('/dashboard')->with('success', 'Welcome back!');
        }

        return back()->with('error', 'Invalid credentials.');
    }
    public function logout(Request $request)
    {
        // ✅ Clear semua session data
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Session::forget('user_role');
        Session::forget('user_id');
        Session::forget('site_visits');

        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
