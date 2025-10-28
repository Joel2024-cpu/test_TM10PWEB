<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Cabin;

class BookingController extends Controller
{
    public function create($id)
    {
        $cabin = Cabin::findOrFail($id);
        return view('bookings.form', compact('cabin'));
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

        Booking::create($request->all());

        // Kirim session pesan sukses
        return redirect()->back()->with('success', 'Terima kasih telah memesan di Bobocabin! Kami menantikan kedatangan Anda 🌿');
    }

    public function index()
    {
        $bookings = \App\Models\Booking::with('cabin')->latest()->get();
        return view('admin.bookings', compact('bookings'));
    }

}
