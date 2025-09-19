<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call DemoDataSeeder for realistic demo data
        $this->call(DemoDataSeeder::class);

        // If additional random data is needed, uncomment the lines below
        /*
        // Create additional users
        \App\Models\User::factory()->count(10)->create();

        // Create additional events
        \App\Models\Event::factory()->count(10)->create();

        // Create additional hosts
        \App\Models\Host::factory()->count(5)->create();

        // Create additional intentions
        \App\Models\Intention::factory()->count(15)->create();

        // Create additional playdates
        \App\Models\Playdate::factory()->count(10)->create();
        */
    }
}
