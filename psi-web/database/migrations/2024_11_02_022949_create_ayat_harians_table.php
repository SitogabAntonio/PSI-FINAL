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
        Schema::create('ayat_harians', function (Blueprint $table) {
            $table->id();
            $table->string('tema');
            $table->string('ayat');
            $table->longText('isi_ayat');
            $table->longText('detail');
            $table->string('tanggal');
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
        Schema::dropIfExists('ayat_harians');
    }
};
