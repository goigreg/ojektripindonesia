<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactions extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    public $timestamps = true;
    protected $fillable = [
        'transaction_code',
        'booking_code',
        'name',
        'price_total',
        'payment_total',
        'bank_name',
        'payment_proof',
        'payment_method',
        'checked'
    ];
    protected $hidden;
}
