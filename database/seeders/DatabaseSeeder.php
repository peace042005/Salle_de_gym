<?php

namespace Database\Seeders;

use App\Models\Outfit;
use App\Models\Pricing;
use App\Models\Room;
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
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'phone_number' => fake()->phoneNumber(),
            'birth_date' => fake()->dateTimeBetween('-60 years', '-24 years'),
            'password' => bcrypt('123')
        ]);

        User::create([
            'first_name' => 'Manager',
            'last_name' => 'Manager',
            'email' => 'manager@manager.com',
            'email_verified_at' => now(),
            'role' => 'manager',
            'phone_number' => fake()->phoneNumber(),
            'birth_date' => fake()->dateTimeBetween('-60 years', '-24 years'),
            'password' => bcrypt('123')
        ]);

        User::create([
            'first_name' => 'User',
            'last_name' => 'User',
            'email' => 'user@user.com',
            'email_verified_at' => now(),
            'role' => 'user',
            'phone_number' => fake()->phoneNumber(),
            'birth_date' => fake()->dateTimeBetween('-60 years', '-24 years'),
            'password' => bcrypt('123')
        ]);

        $pricings = [
            [
                'name' => "Offre 1: Abonnement d'une année (365 jours)",
                'duration' => 360,
                'price' => 120000,
                'user_id'  => $admin->id,
            ],
            [
                'name' => "Offre 2: Abonnement de six mois (180 jours)",
                'duration' => 180,
                'price' => 60000,
                'user_id'  => $admin->id,
            ],
            [
                'name' => "Offre 3: Abonnement de trois mois (90 jours)",
                'duration' => 90,
                'price' => 30000,
                'user_id'  => $admin->id,
            ],
            [
                'name' => "Offre 4: Abonnement d'un mois (30 jours)",
                'duration' => 30,
                'price' => 10000,
                'user_id'  => $admin->id,
            ],
        ];

        foreach ($pricings as $item) {
            Pricing::create($item);
        }

        // User::factory(12)->create();
        // Outfit::factory(70)->create();
        // Room::factory(20)->create();
    }
}
