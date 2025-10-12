<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Intention;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) Random users
        $users = User::factory()->count(48)->create();

        // 2) Admin
        $admin = User::create([
            'name'     => 'admin',
            'email'    => 'admin@admin.com',
            'password' => Hash::make('password'),

        ]);

        // 3) Test user
        $test = User::updateOrCreate(
            ['email' => 'test@test.com'],
            ['name' => 'Test User', 'password' => Hash::make('password')]
        );

        // 4) Pool of all users for random picks
        $allUsers = $users->push($admin, $test);


        $events = Event::factory(20)->make()->each(function (Event $event) use ($allUsers) {
            $event->save();
        });

        // 6) Intentions: link a participant (user) to an event
        Intention::factory(50)->make()->each(function (Intention $intention) use ($allUsers, $events) {
            $intention->user_id  = $allUsers->random()->id;      // participant
            $intention->event_id = $events->random()->id;        // event they join
            $intention->save();
        });
    }
}
