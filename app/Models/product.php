<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = [
        // 'sku',
        // 'product_name',
        // 'product_type',
        // 'category',
        // 'price',
        // 'discount',
        // 'quantity',
        // 'quantity_out',
        // 'product_photo',
        // 'is_active',

        'package_code',
        'package_name',
        'category',
        'price',
        'child_price',
        'discount',
        'people_min',
        'package_photo1',
        'package_photo2',
        'package_photo3',
        'package_desc',
        'itin_loc1',
        'itin_loc2',
        'itin_loc3',
        'itin_loc4',
        'itin_loc5',
        'itin_loc6',
        'itin_loc7',
        'itin_loc8',
        'itin_loc9',
        'itin_loc10',
        'itin_desc1',
        'itin_desc2',
        'itin_desc3',
        'itin_desc4',
        'itin_desc5',
        'itin_desc6',
        'itin_desc7',
        'itin_desc8',
        'itin_desc9',
        'itin_desc10',
        'inclusion',
        'exclusion',
        'note',
        'is_active',
    ];
    // public function product()
    // {
    //     return $this->hasOne(cartproduct::class, 'package_id','id');
    // }
}
