<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customTour extends Model
{
    use HasFactory;
    protected $fillable = [
        'custom_tour_code',
        'user_id',
        'user_name',
        'user_email',
        'user_phone',
        'subject',
        'description',
        'checked'
    ];
}
