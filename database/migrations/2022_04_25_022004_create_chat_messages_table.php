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
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();

            $table->text('text');
            $table->text('translatedText')->nullable();
            $table->boolean('readed')->default(false);
            $table->bigInteger('from_id')->unsigned()->nullable();
            $table->bigInteger('to_id')->unsigned()->nullable();

            $table->bigInteger('room_id')->unsigned()->nullable();
            $table->foreign('room_id')
            ->references('id')
            ->on('chat_rooms')
            ->onDelete('cascade')
            ->onUpdate('cascade');            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
};
