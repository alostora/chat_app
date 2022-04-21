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
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();


            $table->string('sizeName')->nullable();
            $table->string('sizeNameAr')->nullable();
            $table->string('sizeValue')->nullable();
            
            $table->bigInteger('type_id')->unsigned()->nullable();
            $table->foreign('type_id')
            ->references('id')
            ->on('main_types')
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
        Schema::dropIfExists('sizes');
    }
};
