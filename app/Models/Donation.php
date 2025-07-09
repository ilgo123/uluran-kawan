<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'campaign_id',
        'amount',
        'status',
        'is_anonymous',
        'transaction_id',
        // --- KOLOM BARU YANG HARUS DITAMBAHKAN ---
        'payment_method',
        'paid_amount',
        'paid_at',
        'payment_raw_response', // Penting untuk menyimpan respons JSON dari payment gateway
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_anonymous' => 'boolean',
        'paid_at' => 'datetime', // Otomatis konversi ke objek Carbon
        'payment_raw_response' => 'array', // Otomatis konversi JSON string ke array/objek PHP
    ];

    /**
     * Get the user that owns the donation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the campaign that the donation belongs to.
     */
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
