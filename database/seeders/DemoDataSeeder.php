<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Event;
use App\Models\Host;
use App\Models\Intention;
use App\Models\Playdate;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
    /**
     * Seed the application's database with demo data.
     */
    public function run(): void
    {
        // Create admin user
        $adminUser = User::factory()->create([
            'user_name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Create regular users
        $users = [
            User::factory()->create([
                'user_name' => 'Max Mustermann',
                'email' => 'max@example.com',
                'password' => Hash::make('password'),
            ]),
            User::factory()->create([
                'user_name' => 'Maria Schmidt',
                'email' => 'maria@example.com',
                'password' => Hash::make('password'),
            ]),
            User::factory()->create([
                'user_name' => 'Tom Meyer',
                'email' => 'tom@example.com',
                'password' => Hash::make('password'),
            ]),
            User::factory()->create([
                'user_name' => 'Julia Wagner',
                'email' => 'julia@example.com',
                'password' => Hash::make('password'),
            ]),
        ];

        // Create hosts for some users
        $hosts = [];
        foreach ($users as $index => $user) {
            if ($index < 3) { // Make the first 3 users hosts
                $hosts[] = Host::factory()->create([
                    'user_id' => $user->id,
                    'bio' => "This is the bio for {$user->user_name}, who loves organizing playdates for kids.",
                ]);
            }
        }

        // Create events with realistic data
        $events = [
            Event::factory()->create([
                'title' => 'Kids Park Playdate',
                'description' => 'Join us for a fun afternoon at the local park with games and snacks.',
                'scheduled_at' => now()->addDays(7),
                'location' => 'Central Park',
                'user_id' => $users[0]->id,
                'host_id' => $hosts[0]->id,
            ]),
            Event::factory()->create([
                'title' => 'Art & Craft Workshop',
                'description' => 'Creative art session for children aged 5-10 years.',
                'scheduled_at' => now()->addDays(14),
                'location' => 'Community Center',
                'user_id' => $users[1]->id,
                'host_id' => $hosts[1]->id,
            ]),
            Event::factory()->create([
                'title' => 'Swimming Pool Day',
                'description' => 'Fun swimming activities for beginners and advanced kids.',
                'scheduled_at' => now()->addDays(21),
                'location' => 'City Swimming Pool',
                'user_id' => $users[2]->id,
                'host_id' => $hosts[2]->id,
            ]),
        ];

        // Create intentions (RSVPs)
        foreach ($events as $event) {
            // Each event gets some intentions
            foreach ($users as $index => $user) {
                // Skip the event creator
                if ($user->id != $event->user_id) {
                    Intention::factory()->create([
                        'user_id' => $user->id,
                        'event_id' => $event->id,
                        'type' => $index % 3 == 0 ? 'attending' : ($index % 3 == 1 ? 'maybe' : 'not attending'),
                    ]);
                }
            }
        }

        // Create playdates
        $playdates = [
            Playdate::factory()->create([
                'title' => 'After School Meetup',
                'description' => 'Quick play session after school hours',
                'scheduled_at' => now()->addDays(3),
                'user_id' => $users[0]->id,
            ]),
            Playdate::factory()->create([
                'title' => 'Weekend Playdate',
                'description' => 'Weekend fun activities for kids',
                'scheduled_at' => now()->addDays(10),
                'user_id' => $users[1]->id,
            ]),
        ];

        // Create comments
        // Comments on events
        foreach ($events as $event) {
            foreach ($users as $index => $user) {
                if ($index % 2 == 0) { // Add comments for some users
                    Comment::factory()->create([
                        'commentable_id' => $event->id,
                        'commentable_type' => Event::class,
                        'user_id' => $user->id,
                        'content' => "This event looks " . ($index === 0 ? 'amazing' : 'interesting') . "! Can't wait.",
                    ]);
                }
            }
        }

        // Comments on playdates
        foreach ($playdates as $playdate) {
            foreach ($users as $index => $user) {
                if ($index % 3 == 0) { // Add comments for some users
                    Comment::factory()->create([
                        'commentable_id' => $playdate->id,
                        'commentable_type' => Playdate::class,
                        'user_id' => $user->id,
                        'content' => "Looking forward to this playdate!",
                    ]);
                }
            }
        }
    }
}
