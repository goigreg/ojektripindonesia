<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_number',
        'user_id',
        'package_id',
        'name',
        'number_of_adult',
        'number_of_child',
        'number_of_infant',
        'booking_code',
        'package_name',
        'departure_date',
        'note',
        'status'
    ];
}
