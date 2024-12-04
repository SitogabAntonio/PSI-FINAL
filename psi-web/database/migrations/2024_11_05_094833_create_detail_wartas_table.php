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
        Schema::create('detail_wartas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warta_jemaat_id')->constrained('warta_jemaats')->onDelete('cascade');
            $table->string('header');
            $table->text('isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_wartas');
    }
};
