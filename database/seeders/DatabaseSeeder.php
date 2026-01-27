<?php

namespace Database\Seeders;

use App\Models\Rundown;
use App\Models\Sponsor;
use App\Models\Umkm;
use App\Models\University;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        if (!User::where('email', 'admin@udo.com')->exists()) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@udo.com',
                'password' => bcrypt('password'),
            ]);
        }

        // Sponsors
        Sponsor::factory()->count(3)->platinum()->create();
        Sponsor::factory()->count(8)->gold()->create();
        Sponsor::factory()->count(5)->silver()->create(); // or media partner, treating as silver/others

        // Universities
        $this->call(UniversitySeeder::class);

        // UMKMs
        Umkm::factory()->count(6)->create();

        // Rundown
        Rundown::factory()->count(4)->create();
    }
}
