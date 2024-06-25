<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class companyprofile extends Model
{
    use HasFactory;
    protected $fillable = [
        'primary_logo',
        'secondary_logo',
        'about_company',
        'vision',
        'mission',
        'main_email',
        'other_email',
        'main_phone',
        'other_phone',
        'address',
    ];
}
