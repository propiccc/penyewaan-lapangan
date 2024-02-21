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
        Schema::create('sewas', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->enum('status_sewa', ['pending', 'berjalan', 'expired'])->default('pending');
            $table->enum('status_pembayaran', ['pending','process', 'lunas', 'expired'])->default('pending');
            
            $table->string('image_pembayaran')->nullable();
            $table->string('kode_boking');
            $table->decimal('price', 15, 3);

            $table->date('tanggal_sewa');
            $table->time('waktu_sewa_mulai');
            $table->time('waktu_sewa_selesai');

            $table->unsignedBiginteger('lapangan_id');
            $table->foreign('lapangan_id')->references('id')->on('lapangans')->onDelete('cascade');

            $table->unsignedBiginteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');    

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewas');
    }
};
