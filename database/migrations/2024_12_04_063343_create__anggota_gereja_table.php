<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('anggota_gereja', function (Blueprint $table) {
            $table->id(); // ID untuk tiap record
            $table->string('keluarga'); // Nama keluarga
            $table->string('no_kk'); // Nomor KK
            $table->string('nama'); // Nama anggota keluarga
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->index('user_id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_anggota_gereja');
    }
};
