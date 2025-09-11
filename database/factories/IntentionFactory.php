<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
                'intention_text' => $this->faker->sentence(8), // short phrase
                'is_permanent'   => $this->faker->boolean(30), // ~30% true
                'category'       => $this->faker->randomElement([
                    'Health', 'Career', 'Relationships', 'Personal Growth', 'Finance'
                ]),  //
        ];
    }
}
