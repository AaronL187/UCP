<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NameChange>
 */
class NameChangeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'character_id' => $this->faker->unique()->numberBetween(1, 100),
            'old_name' => $this->faker->name,
            'new_name' => $this->faker->name,
            'reason' => $this->faker->text,
            'status' => null, // assuming 'null' is pending
            'handled_by' => 0, // can be left out if it's nullable and not required for seeding
        ];
    }
}


