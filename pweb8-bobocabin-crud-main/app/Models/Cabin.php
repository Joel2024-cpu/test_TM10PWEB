<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabin extends Model
{
    protected $table = 'cabins';
    protected $fillable = ['nama_cabin', 'lokasi', 'harga_per_malam', 'gambar'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
