<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Characters>
 */
class CharactersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'charactername' => $this->faker->name,
            'account' => \App\Models\User::inRandomOrder()->first()->id, // Fetches a random user's ID
            'x' => $this->faker->randomFloat(6, -5000, 5000),
            'y' => $this->faker->randomFloat(6, -5000, 5000),
            'z' => $this->faker->randomFloat(6, -5000, 5000),
            'health' => $this->faker->numberBetween(0, 100),
            'armor' => $this->faker->numberBetween(0, 100),
            'last_login_time' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'hunger' => $this->faker->numberBetween(0, 100),
            'thirst' => $this->faker->numberBetween(0, 100),
            'adminnick' => 'Ismeretlen',
            'dimension_id' => $this->faker->randomDigit,
            'money' => $this->faker->numberBetween(1000, 500000),
            'pp' => $this->faker->randomNumber(),
            'skin_id' => $this->faker->numberBetween(1, 200),
            'age' => $this->faker->numberBetween(18, 80),
            'maxvehs' => $this->faker->numberBetween(0, 10),
            'maxinteriors' => $this->faker->numberBetween(0, 10),
            'faction_id' => null,
            'petID' => null,
            'chatblock' => null
        ];
    }
}
