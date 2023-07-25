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
        Schema::create('transaksi_sampah', function (Blueprint $table) {
            $table->id('transaksi_sampah_id');
            $table->unsignedBigInteger('transaksi_id');
            $table->unsignedBigInteger('tipe_sampah_id');
            $table->string('timbangan');
            $table->string('harga');
            $table->timestamps();

            $table->foreign('transaksi_id')->references('transaksi_id')->on('transaksi');
            $table->foreign('tipe_sampah_id')->references('tipe_sampah_id')->on('tipe_sampah');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_sampah');
    }
};
