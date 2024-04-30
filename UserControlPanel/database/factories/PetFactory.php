<?php

namespace Database\Factories;
use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    protected $model = Pet::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        return [
                'owner_id' => $faker->numberBetween(1, 100),  // Assume you have 100 characters
                'pettype' => $faker->randomElement(['dog', 'cat', 'bird', 'fish', 'lizard']),
                'hunger' => $faker->numberBetween(0, 100),
                'thirst' => $faker->numberBetween(0, 100),
                'name' => $faker->firstName,
                'created_at' => now(),
                'updated_at' => now(),
        ];
    }
}
