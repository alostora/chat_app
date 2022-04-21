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
        Schema::create('user_langs', function (Blueprint $table) {
            $table->id();


            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->bigInteger('lang_id')->unsigned()->nullable();
            $table->foreign('lang_id')
            ->references('id')
            ->on('langs')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->enum('type',['teach','study']);


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
        Schema::dropIfExists('user_langs');
    }
};
