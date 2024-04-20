<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehiclesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            return [
                'owner_id' => \App\Models\Characters::inRandomOrder()->first()->id,  // Assuming Character model exists and has records
                'model' => $this->faker->numberBetween(400, 611),  // Adjust according to vehicle models
                'r' => $this->faker->numberBetween(0, 255),
                'g' => $this->faker->numberBetween(0, 255),
                'b' => $this->faker->numberBetween(0, 255),
                'x' => $this->faker->randomFloat(6, -5000, 5000),
                'y' => $this->faker->randomFloat(6, -5000, 5000),
                'z' => $this->faker->randomFloat(6, -5000, 5000),
                'tuning' => json_encode(['wheels' => $this->faker->randomElement([1, 2, 3]), 'engine' => $this->faker->randomElement([1, 2, 3]), 'ecu' => $this->faker->randomElement([1, 2, 3]), 'transmission' => $this->faker->randomElement([1, 2, 3]), 'nitro' => $this->faker->randomElement([1, 2, 3])] ),
                'dimension' => $this->faker->numberBetween(0, 65568),
                'interior' => $this->faker->numberBetween(0, 65568),
                'faction_id' => null,  // Adjust according to faction existence
                'impound' => $this->faker->boolean,
                'paintjob' => $this->faker->randomElement([null, 1, 2, 3]),
                'deletion_info' => null,
            ];
    }
}
