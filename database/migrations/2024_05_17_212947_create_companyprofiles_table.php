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
        Schema::create('companyprofiles', function (Blueprint $table) {
            $table->id();
            $table->string('primary_logo');
            $table->string('secondary_logo');
            $table->longText('about_company');
            $table->longText('vision');
            $table->longText('mission');
            $table->string('main_email');
            $table->longText('other_email');
            $table->string('main_phone');
            $table->longText('other_phone');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companyprofiles');
    }
};
