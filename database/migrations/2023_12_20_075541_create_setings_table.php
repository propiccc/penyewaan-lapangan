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
        Schema::create('setings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
        
            $table->string('no_rek');
            $table->string('nama_pemilik_rek');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setings');
    }
};
