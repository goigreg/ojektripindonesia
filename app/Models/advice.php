<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class advice extends Model
{
    use HasFactory;
    protected $table = 'advices';
    public $timestamps = true;
    protected $fillable = [
        'email',
        'advice',
        'checked'               
    ];
}
