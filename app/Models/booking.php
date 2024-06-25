<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'package_id',
        'booking_code',
        'name',        
        'number_of_adult',        
        'number_of_child',        
        'number_of_infant',        
        'price_total',        
        'remaining_payment',        
        'email',        
        'phone',        
        'package_name',        
        'departure_date',        
        'payment_status',        
        'checked',        
        'snap_token',       
    ];
}
