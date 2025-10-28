<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Cabin;

class CabinController extends Controller
{
    public function index()
    {
        $cabins = Cabin::all();

        // ✅ SESSION: Track cabin page visits
        Session::put('cabin_visits', Session::get('cabin_visits', 0) + 1);

        // ✅ COOKIES: Get user preferences
        $prefs = json_decode(request()->cookie('bobocabin_prefs', '{}'), true);
        $currency = $prefs['currency'] ?? 'IDR';
        $theme = $prefs['theme'] ?? 'light';

        return view('cabins.index', compact('cabins', 'currency', 'theme'));
    }

    public function show($id)
    {
        $cabin = Cabin::findOrFail($id);

        // ✅ PROFESSIONAL: Track cabin views untuk personalization
        $userActivity = Session::get('user_activity', []);

        // Track viewed cabins (max 10 terakhir)
        $viewedCabins = $userActivity['cabin_views'] ?? [];
        array_unshift($viewedCabins, [
            'cabin_id' => $id,
            'cabin_name' => $cabin->nama_cabin,
            'viewed_at' => now()->toDateTimeString()
        ]);
        $viewedCabins = array_slice($viewedCabins, 0, 10);

        // Increment page views
        $userActivity['page_views'] = ($userActivity['page_views'] ?? 0) + 1;
        $userActivity['cabin_views'] = $viewedCabins;

        Session::put('user_activity', $userActivity);

        return view('cabins.detail', compact('cabin'));
    }

    // ✅ NEW: Search cabins with cookies
    public function search(Request $request)
    {
        $cabins = Cabin::when($request->location, function($query) use ($request) {
            return $query->where('lokasi', 'like', '%'.$request->location.'%');
        })->get();

        // ✅ PROFESSIONAL: Track search queries untuk analytics
        if ($request->location) {
            $userActivity = Session::get('user_activity', []);
            $searchQueries = $userActivity['search_queries'] ?? [];

            array_unshift($searchQueries, [
                'query' => $request->location,
                'results_count' => $cabins->count(),
                'searched_at' => now()->toDateTimeString()
            ]);

            $userActivity['search_queries'] = array_slice($searchQueries, 0, 10);
            Session::put('user_activity', $userActivity);
        }

        return view('cabins.index', compact('cabins'));
    }
}
