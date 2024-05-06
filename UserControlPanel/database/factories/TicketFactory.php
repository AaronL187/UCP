<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */

use App\Models\Ticket;


class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'ticket_by' => \App\Models\User::factory(),
            'problem' => $this->faker->text(200),
            'status' => $this->faker->randomElement([0, 1]), // Assuming these are the statuses
            'handled_by' => null,
            'reason' => $this->faker->sentence,
            'reward' => $this->faker->numberBetween(0, 100),
            'proofurl' => $this->faker->url,
        ];
    }
}

