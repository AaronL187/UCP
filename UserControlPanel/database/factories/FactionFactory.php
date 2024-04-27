<?php

namespace Database\Factories;

use App\Models\Faction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faction>
 */
class FactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Faction::class;
    public function definition()
    {
        return [
            'factiontype' => $this->faker->numberBetween(1, 4),
            'name' => $this->faker->company, // Generates an organization name
            'factiondata' => json_encode([
                'size' => $this->faker->numberBetween(50, 500),
                'motto' => $this->faker->sentence
            ]),
            'balance' => $this->faker->numberBetween(1000, 10000000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

}
