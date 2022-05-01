<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lang;
use App\Models\chat\User_lang;

class LangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Lang::factory(40)->create();
    }
}
