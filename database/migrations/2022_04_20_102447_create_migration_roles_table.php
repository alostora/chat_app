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
        Schema::create('migration_roles', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('permission_id')->unsigned()->nullable();
            $table->foreign('permission_id')
            ->references('id')
            ->on('permissions')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->integer('migration_id')->unsigned()->nullable();
            $table->foreign('migration_id')
            ->references('id')
            ->on('migrations')
            ->onDelete('cascade')
            ->onUpdate('cascade');


            $table->bigInteger('role_id')->unsigned()->nullable();
            $table->foreign('role_id')
            ->references('id')
            ->on('roles')
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
        Schema::dropIfExists('migration_roles');
    }
};
