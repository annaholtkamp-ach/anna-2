<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'scheduled_at' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
            'location' => $this->faker->address,
            'user_id' => \App\Models\User::factory(),
            'host_id' => \App\Models\Host::factory()
        ];
    }
}
