<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionDetails extends Model
{
    use HasFactory;
    protected $table = 'transaction_details';
    public $timestamps = true;
    protected $fillable = [
        'transaction_id',
        'package_id',        
        'quantity',        
        'price',        
        'status',        
    ];

    // public function transactions()
    // {
    //     return $this->hasOne(transactions::class, 'transaction_id', 'id');
    // }
    // public function product()
    // {
    //     return $this->hasOne(product::class, 'package_id', 'id');
    // }
}
