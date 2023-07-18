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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer('staff_id');
            $table->integer('anggota_id');
            $table->string('kode_transaksi',255);
            $table->integer('jumlah_uang');
            $table->date('tanngal_transaksi');
            $table->string('arus_transaksi', 50);
            $table->timestamps();

            $table->foreign('staff_id')->references('id')->on('staff');
            $table->foreign('anggota_id')->references('id')->on('anggota');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
