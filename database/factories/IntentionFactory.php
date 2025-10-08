<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\event;
use App\Models\Intention;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\intention>
 */
class IntentionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return ['user_id'  => User::factory(),
                'event_id' => event::factory(),
                'intention_text' => $this->faker->sentence(8), // short phrase
                'is_permanent'   => $this->faker->boolean(30), // ~30% true
                'category'       => $this->faker->randomElement([
                    'Health', 'Career', 'Relationships', 'Personal Growth', 'Finance'
                ]),  //
        ];
    }
}
