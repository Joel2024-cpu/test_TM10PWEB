<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PreferenceController extends Controller
{
    // ✅ COOKIES: Set user preferences
    public function setPreferences(Request $request)
    {
        $request->validate([
            'theme' => 'required|in:light,dark',
            'currency' => 'required|in:IDR,USD',
            'language' => 'required|in:id,en'
        ]);

        $preferences = [
            'theme' => $request->theme,
            'currency' => $request->currency,
            'language' => $request->language,
            'updated_at' => now()->toISOString()
        ];

        // ✅ COOKIES: Simpan preferensi (30 hari)
        $cookie = cookie('bobocabin_prefs', json_encode($preferences), 60*24*30);

        return redirect()->back()
            ->withCookie($cookie)
            ->with('success', 'Preferensi berhasil disimpan! 🎨');
    }

    // ✅ COOKIES: Set search history
    public function saveSearch(Request $request)
    {
        $searchHistory = json_decode($request->cookie('search_history', '[]'), true);

        $newSearch = [
            'location' => $request->location,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
            'searched_at' => now()->toISOString()
        ];

        array_unshift($searchHistory, $newSearch);
        $searchHistory = array_slice($searchHistory, 0, 5); // Keep last 5 searches

        $cookie = cookie('search_history', json_encode($searchHistory), 60*24*7); // 7 hari

        return response()->json(['success' => true])->cookie($cookie);
    }
}
