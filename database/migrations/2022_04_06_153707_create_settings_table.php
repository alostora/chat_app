<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('siteName')->nullable();
            $table->string('siteNameAr')->nullable();
            $table->string('siteEmail')->nullable();
            $table->string('siteMobile')->nullable();
            $table->string('sitePhone')->nullable();
            $table->text('siteDesc')->nullable();
            $table->text('siteDescAr')->nullable();
            $table->string('siteImage')->nullable();
            $table->string('siteLogo')->nullable();
            $table->boolean('is_live')->default(1);
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
        Schema::dropIfExists('settings');
    }
}
