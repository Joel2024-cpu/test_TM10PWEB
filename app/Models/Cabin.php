<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabin extends Model
{
    protected $table = 'cabins';
    protected $fillable = ['nama_cabin', 'lokasi', 'harga_per_malam', 'gambar', 'kapasitas', 'fasilitas'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // ✅ Helper methods
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->harga_per_malam, 0, ',', '.');
    }

    public function isAvailable($checkIn, $checkOut)
    {
        return !$this->bookings()
            ->where(function($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                      ->orWhereBetween('check_out', [$checkIn, $checkOut]);
            })
            ->exists();
    }
}
