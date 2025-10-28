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
        'cabin_id',
        'status',
        'total_harga'
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function cabin()
    {
        return $this->belongsTo(Cabin::class);
    }

    // ✅ Calculate total price
    public function calculateTotal()
    {
        $nights = $this->check_in->diffInDays($this->check_out);
        return $nights * $this->cabin->harga_per_malam;
    }

    // ✅ Status helpers
    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }
}
