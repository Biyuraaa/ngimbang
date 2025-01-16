<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('categories')->insert([
            [
                'name' => 'Electronics',
                'description' => 'Devices and gadgets for everyday use',
            ],
            [
                'name' => 'Fashion',
                'description' => 'Clothing, accessories, and more',
            ],
            [
                'name' => 'Books',
                'description' => 'Educational and leisure reading materials',
            ],
            [
                'name' => 'Home Appliances',
                'description' => 'Tools and equipment for home improvement',
            ],
            [
                'name' => 'Sports',
                'description' => 'Sporting goods and fitness equipment',
            ],
        ]);
    }
}
