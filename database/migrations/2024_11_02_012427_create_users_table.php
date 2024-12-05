<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('phone')->nullable();
            $table->longtext('location')->nullable();
            $table->longtext('about_me')->nullable();
            $table->longText('image')->nullable();
            $table->string('status')->default('ACTIVE');
            $table->string('domain')->unique();
            $table->longText('google_map')->nullable();
            $table->foreignId('role_id')->default(2)->constrained('roles');
            $table->rememberToken();
            $table->timestamps();
            $table->index('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
