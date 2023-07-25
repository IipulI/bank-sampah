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
        Schema::create('tipe_sampah', function (Blueprint $table) {
            $table->id('tipe_sampah_id');
            $table->string('nama', 255);
            $table->string('satuan', 20);
            $table->string('harga_satuan', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipe_sampah');
    }
};
