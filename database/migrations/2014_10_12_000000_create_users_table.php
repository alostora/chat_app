<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable()->unique();
            $table->enum('gender',['male','female'])->nullable();
            $table->string('birthDate')->nullable();
            $table->string('image')->default('defaultLogo.png');
            $table->string('api_token')->unique()->nullable();
            $table->string('verify_token')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('country')->nullable();
            $table->string('country_key')->nullable();
            $table->boolean('online')->default(0);
            $table->string('last_login_at')->nullable();
            $table->text('bio')->nullable();
            $table->string('firebase_token')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
