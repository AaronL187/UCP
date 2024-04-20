<?php

namespace Database\Factories;
use App\Models\SerialChange;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SerialChange>
 */
class SerialChangeFactory extends Factory
{
    protected $model = SerialChange::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
           return [
               'date' => $this->faker->dateTimeThisYear(), // Generates a datetime for this year
               'character_id' => $this->faker->numberBetween(1, 100), // Character ID between 1 and 100
               'old_serial' => $this->faker->regexify('[A-Fa-f0-9]{32}'), // Generates a 32-character hexadecimal string
               'new_serial' => $this->faker->regexify('[A-Fa-f0-9]{32}'), // Generates a 32-character hexadecimal string
               'reason' => $this->faker->text(200), // Generates a random text up to 200 characters as the reason
               'handled_by' => $this->faker->numberBetween(1, 100), // Admin ID handling the change, between 1 and 100
               'status' => $this->faker->optional()->randomElement([0, 1]) // Randomly picks either 0, 1 or null
           ];
    }
}
