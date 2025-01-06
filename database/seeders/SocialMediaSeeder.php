<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $socialMedias = [
            ['platform' => 'Facebook'],
            ['platform' => 'Instagram'],
            ['platform' => 'Twitter'],
            ['platform' => 'YouTube'],
            ['platform' => 'TikTok'],
            ['platform' => 'Pinterest'],
            ['platform' => 'Snapchat'],
            ['platform' => 'WhatsApp'],
            ['platform' => 'Telegram'],
            ['platform' => 'Line'],
            ['platform' => 'Lazada'],
        ];

        DB::table('social_media')->insert($socialMedias);
    }
}
