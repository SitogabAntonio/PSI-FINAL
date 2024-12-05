<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DetailWartaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $duplicateWartaIds = [
            $faker->numberBetween(1, 50),
            $faker->numberBetween(1, 50),
        ];

        foreach ($duplicateWartaIds as $wartaId) {
            for ($i = 0; $i < 4; $i++) {
                DB::table('detail_wartas')->insert([
                    'warta_jemaat_id' => $wartaId,
                    'header' => $faker->sentence(6),
                    'isi' => $faker->sentence(15),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $remainingEntries = 50 - (4 * count($duplicateWartaIds));
        for ($i = 0; $i < $remainingEntries; $i++) {
            DB::table('detail_wartas')->insert([
                'warta_jemaat_id' => $faker->numberBetween(1, 50),
                'header' => $faker->sentence(6),
                'isi' => $faker->sentence(15),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
