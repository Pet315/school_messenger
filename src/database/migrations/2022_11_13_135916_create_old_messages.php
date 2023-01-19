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
        Schema::create('old_messages', function (Blueprint $table) {
            $table->id();
            $table->string('value');
//            $table->string('user');
//            $table->integer('room');
//            $table->timestamps();
        });

        Schema::table('old_messages', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
        });

        Schema::table('old_messages', function (Blueprint $table) {
            $table->foreignId('chat_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('old_messages');
    }
};
