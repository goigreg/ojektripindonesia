<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class message extends Model
{
    use HasFactory;
    protected $table = 'messages';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'checked'               
    ];
}
