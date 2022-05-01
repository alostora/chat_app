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
        Schema::create('user_report_lists', function (Blueprint $table) {
            $table->id();
            $table->boolean('admin_action')->default(false);
            $table->string('report_reason')->nullable();

            $table->bigInteger('report_to')->unsigned();
            $table->foreign('report_to')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->bigInteger('report_from')->unsigned()->nullable();
            $table->foreign('report_from')
            ->references('id')
            ->on('users')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->bigInteger('admin_id')->unsigned()->nullable();
            $table->foreign('admin_id')
            ->references('id')
            ->on('users')
            ->onDelete('set null')
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
        Schema::dropIfExists('user_report_lists');
    }
};
