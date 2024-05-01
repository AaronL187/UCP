<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Suggestion>
 */
class SuggestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'suggested_by' => \App\Models\User::factory(),  // Assuming User model exists and you want to auto-create users
            'suggestion' => $this->faker->text(200),
            'status' => $this->faker->optional($weight = 0.9, $default = null)->randomElement([0, 1]),
            'handled_by' => $this->faker->optional()->numberBetween(1, 100), // Or use User::factory() if you want to associate real users
            'reason' => $this->faker->optional()->sentence(),
            'handled_at' => $this->faker->optional()->dateTimeThisYear(),
            'reward' => $this->faker->numberBetween(0, 100),
        ];
    }
}
