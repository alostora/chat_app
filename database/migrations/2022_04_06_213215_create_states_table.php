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
        Schema::create('states', function (Blueprint $table) {
            $table->id();

            $table->string('stateName')->nullable();
            $table->string('stateNameAr')->nullable();

            $table->bigInteger('city_id')->unsigned()->nullable();
            $table->foreign('city_id')
            ->references('id')
            ->on('cities')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')
            ->references('id')
            ->on('countries')
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
        Schema::dropIfExists('states');
    }
};
