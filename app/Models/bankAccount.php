<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bankAccount extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank_name',
        'bank_logo',
        'account_name',
        'account_number',
    ];
}
