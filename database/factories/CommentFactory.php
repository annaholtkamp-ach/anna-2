<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $commentable = $this->faker->randomElement([
            \App\Models\Event::class,
            \App\Models\Playdate::class
        ]);

        return [
            'content' => $this->faker->paragraph(),
            'user_id' => \App\Models\User::factory(),
            'commentable_id' => $commentable::factory(),
            'commentable_type' => $commentable
        ];
    }
}
