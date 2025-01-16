<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Umkm;
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
        // User::factory(10)->create();
        $this->call([
            RolePermissionSeeder::class,
            PriceRuleTypeSeeder::class,
            SocialMediaSeeder::class,
            CategorySeeder::class,
        ]);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'slug' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('super-admin');


        $destination = User::factory()->create([
            'name' => 'Destination',
            'slug' => 'destination',
            'email' => 'destination@destination.com',
            'password' => bcrypt('password'),
        ]);

        $destination->assignRole('destination-owner');

        $umkm = User::factory()->create([
            'name' => 'UMKM',
            'slug' => 'umkm',
            'email' => 'umkm@umkm.com',
            'password' => bcrypt('password'),
        ]);

        $umkm->assignRole('umkm');

        Destination::create([
            'user_id' => $destination->id,
            'name' => 'Destination',
            'slug' => 'destination',
            'address' => 'Jl. Destination',
            'description' => 'Destination Description',
        ]);

        Umkm::create([
            'user_id' => $umkm->id,
            'name' => 'UMKM',
            'slug' => 'umkm',
            'address' => 'Jl. UMKM',
            'description' => 'UMKM Description',
        ]);
    }
}
