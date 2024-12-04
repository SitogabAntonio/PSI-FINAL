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
        Schema::create('warta_jemaats', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penkotbah');
            $table->longText('judul_renungan');
            $table->longText('isi_renungan');
            $table->longText('deskripsi_pengumuman');
            $table->date('tanggal');
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
        Schema::dropIfExists('warta_jemaats');
    }
};
