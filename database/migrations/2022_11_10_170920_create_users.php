<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('email');
//            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('name_surname');
            $table->string('patronymic')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('other_info')->nullable();
//            $table->unsignedBigInteger('role_id')->unique();
//            $table->rememberToken();
//            $table->timestamps();
        });
//
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained();
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
};
