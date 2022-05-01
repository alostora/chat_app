<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserLangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "langName"=>$this->\App\Models\User::factory(),
            "langCode"=>$this->\App\Models\Lang::factory(),
            "type"=>$this->shuffle(['teach','study'])[0],
        ];
    }
}
