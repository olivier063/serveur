<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Annonces>
 */
class AnnoncesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {


        return [
            'description'=> $this->faker->sentence(10, true),
            'user_id'=>rand(1, 10),
            'titre'=> $this->faker->sentence(5, true),
            'auteur'=> $this->faker->sentence(5, true),
            'prix'=> $this->faker->randomFloat(3, 3, 10),
            'nombre de like'=> $this->faker->randomNumber(2),
            'image'=> $this->faker->sentence(5, true),            
            
        ];
    }
}
