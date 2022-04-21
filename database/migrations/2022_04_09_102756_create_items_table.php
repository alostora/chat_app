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
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->string('itemName')->nullable();
            $table->string('itemNameAr')->nullable();
            $table->text('itemDesc')->nullable();
            $table->text('itemDescAr')->nullable();
            $table->integer('itemPrice')->default(0);
            $table->integer('itemCount')->default(1);
            $table->integer('itemDiscount')->default(0);
            $table->boolean('active')->default(0);
            //same size type in sizes&category table references main_types table
            $table->bigInteger('type_id')->unsigned()->nullable();


            $table->bigInteger('sub_cat_id')->unsigned()->nullable();
            $table->foreign('sub_cat_id')
            ->references('id')
            ->on('s_categories')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('cat_id')->unsigned()->nullable();
            $table->foreign('cat_id')
            ->references('id')
            ->on('categories')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')
            ->references('id')
            ->on('countries')
            ->nullOnDelete()
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
        Schema::dropIfExists('items');
    }
};
