<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'hosam zaki',
            'email' => 'dolsika5762@gmail.com',
            'password' => \Hash::make(123456), // password
            'remember_token' => \Str::random(10),
        ];
    }
}
