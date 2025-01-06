<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceRuleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $priceRuleTypes = [
            [
                'name' => 'Weekend',
                'description' => 'Aturan harga khusus untuk akhir pekan (Sabtu dan Minggu).',
            ],
            [
                'name' => 'Weekdays',
                'description' => 'Aturan harga khusus untuk hari kerja (Senin hingga Jumat).',
            ],
            [
                'name' => 'Libur Panjang',
                'description' => 'Aturan harga untuk masa libur panjang seperti liburan sekolah atau nasional.',
            ],
            [
                'name' => 'Lebaran',
                'description' => 'Aturan harga khusus untuk masa perayaan Idul Fitri.',
            ],
            [
                'name' => 'Natal dan Tahun Baru',
                'description' => 'Aturan harga khusus untuk periode Natal dan Tahun Baru.',
            ],
        ];

        DB::table('price_rule_types')->insert($priceRuleTypes);
    }
}
