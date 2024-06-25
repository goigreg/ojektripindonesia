<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            // $table->id();
            // $table->string('sku');
            // $table->string('product_name');
            // $table->string('product_type');
            // $table->string('category');
            // $table->bigInteger('price');
            // $table->float('discount');
            // $table->integer('quantity');
            // $table->integer('quantity_out')->default(0);
            // $table->string('product_photo');
            // $table->boolean('is_active')->default(1);
            // $table->timestamps();

            $table->id();
            $table->string('package_code');
            $table->string('package_name');
            $table->integer('category');
            $table->bigInteger('price');
            $table->bigInteger('child_price');
            $table->float('discount');
            $table->integer('people_min');
            $table->string('package_photo1');
            $table->string('package_photo2');
            $table->string('package_photo3');
            $table->longText('package_desc');
            $table->string('itin_loc1');
            $table->string('itin_loc2');
            $table->string('itin_loc3');
            $table->string('itin_loc4');
            $table->string('itin_loc5');
            $table->string('itin_loc6');
            $table->string('itin_loc7');
            $table->string('itin_loc8');
            $table->string('itin_loc9');
            $table->string('itin_loc10');
            $table->string('itin_desc1');
            $table->string('itin_desc2');
            $table->string('itin_desc3');
            $table->string('itin_desc4');
            $table->string('itin_desc5');
            $table->string('itin_desc6');
            $table->string('itin_desc7');
            $table->string('itin_desc8');
            $table->string('itin_desc9');
            $table->string('itin_desc10');
            $table->longText('inclusion');
            $table->longText('exclusion');
            $table->longText('note');
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
