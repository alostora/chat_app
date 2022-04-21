<?php

namespace Database\Seeders;
use Illuminate\Database\Eloquent\Factories\Sequence;

use Illuminate\Database\Seeder;
use \App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(2)->create();
    }
}
