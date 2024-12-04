<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class KeuanganSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            $nominal = $faker->randomFloat(2, 0, 100000);
            $total = $faker->randomFloat(2, 0, 100000);

            DB::table('keuangans')->insert([
                'header' => $faker->sentence(6),
                'nominal' => $nominal,
                'total' => $total,
                'tanggal' => $faker->dateTimeBetween('-1 months', '+1 months'),
                'user_id' => $faker->numberBetween(6, 30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
