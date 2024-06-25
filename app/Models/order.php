<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = [
        'booking_code',
        'name',        
        'number_of_people',        
        'price_total',        
        'email',        
        'phone',        
        'package_name',        
        'departure_date',        
    ];
}
