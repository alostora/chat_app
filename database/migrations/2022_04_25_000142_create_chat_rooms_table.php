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
        Schema::create('chat_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->bigInteger('last_message_id')->unsigned()->unique()->nullable();
            $table->integer('unread_parent_count')->unsigned()->default(0);
            $table->integer('unread_child_count')->unsigned()->default(0);

            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('child_id')->unsigned()->nullable();
            $table->foreign('child_id')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('chat_rooms');
    }
};
