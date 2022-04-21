<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $path = public_path('Admin_uploads/categories');
        $image = $this->faker->image($path);

        return [
            'categoryName' => $this->faker->name(),
            'categoryImage' => substr($image ,(strlen($path)+1) - strlen($image )),//onley image name without link
        ];
    }
}
