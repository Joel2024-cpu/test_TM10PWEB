<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Booking;
use App\Models\Cabin;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function create($id)
    {
        $cabin = Cabin::findOrFail($id);

        // ✅ COOKIES: Ambil preferensi dari cookies
        $currency = request()->cookie('currency', 'IDR');
        $language = request()->cookie('language', 'id');

        return view('bookings.form', compact('cabin', 'currency', 'language'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required',
            'email' => 'required|email',
            'metode_pembayaran' => 'required',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'cabin_id' => 'required|exists:cabins,id'
        ]);

        // ✅ PROFESSIONAL: Simpan booking process state
        Session::put('booking_process', [
            'current_step' => 'completed',
            'steps_completed' => ['cabin_selection', 'guest_info', 'payment_method'],
            'booking_data' => [
                'cabin_id' => $request->cabin_id,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'guests' => 2, // Default atau dari input
                'total_amount' => Cabin::find($request->cabin_id)->harga_per_malam * 1 // Calculate properly
            ],
            'started_at' => now()->toDateTimeString(),
            'completed_at' => now()->toDateTimeString()
        ]);

        // ✅ Update user activity
        $userActivity = Session::get('user_activity', []);
        $userActivity['booking_attempts'] = ($userActivity['booking_attempts'] ?? 0) + 1;
        Session::put('user_activity', $userActivity);

        $booking = Booking::create($request->all());

        return redirect()->back()->with('success', 'Booking confirmed!');
    }
    public function index()
    {
        // ✅ AUTHORIZATION: Cek role dari session
        if (Session::get('user_role') !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang bisa melihat daftar booking.');
        }

        $bookings = Booking::with('cabin')->latest()->get();

        // ✅ SESSION: Track admin activity
        Session::put('admin_visits', Session::get('admin_visits', 0) + 1);

        return view('admin.bookings', compact('bookings'));
    }

    // ✅ NEW: Wishlist functionality (SESSION - Bukan login)
    public function addToWishlist(Request $request)
    {
        $wishlist = Session::get('wishlist', []);

        if (!in_array($request->cabin_id, $wishlist)) {
            $wishlist[] = $request->cabin_id;
            Session::put('wishlist', $wishlist);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cabin ditambahkan ke wishlist! 💖',
            'wishlist_count' => count($wishlist)
        ]);
    }

    // ✅ NEW: Get wishlist
    public function getWishlist()
    {
        $wishlistIds = Session::get('wishlist', []);
        $cabins = Cabin::whereIn('id', $wishlistIds)->get();

        return view('wishlist', compact('cabins'));
    }
}
