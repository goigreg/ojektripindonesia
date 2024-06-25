<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cartproduct extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'package_id',        
        'quantity',        
        'package_price',        
        'status',        
    ];
    // public function product()
    // {
    //     return $this->hasOne(product::class, 'id' , 'package_id');
    // }
}
