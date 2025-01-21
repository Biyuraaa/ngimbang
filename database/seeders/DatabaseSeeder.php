<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Umkm;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Faq;
use App\Models\Gallery;

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
        Faq::factory(15)->create();


        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');

        Destination::factory(10)->create();

        Gallery::factory(10)->create();
    }
}
