<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'nama_pemesan',
        'email',
        'metode_pembayaran',   
        'check_in',
        'check_out',
        'cabin_id'
    ];

    public function cabin()
    {
        return $this->belongsTo(Cabin::class);
    }
}
