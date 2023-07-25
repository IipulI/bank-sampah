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
            $table->id('transaksi_id');
            $table->unsignedBigInteger('staff_id');
            $table->string('no_nik', 255);
            $table->string('kode_transaksi',255);
            $table->integer('jumlah_uang');
            $table->date('tanggal_transaksi');
            $table->string('arus_transaksi', 50);
            $table->timestamps();

            $table->foreign('staff_id')->references('staff_id')->on('staff');
            $table->foreign('no_nik')->references('no_nik')->on('masyarakat');
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
