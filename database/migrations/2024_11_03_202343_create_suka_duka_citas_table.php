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
        Schema::create('suka_duka_citas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->longText('description');
            $table->longText('detail');
            $table->string('tanggal');
            $table->string('category');
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
        Schema::dropIfExists('suka_duka_citas');
    }
};
