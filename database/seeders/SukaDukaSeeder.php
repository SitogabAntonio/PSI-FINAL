<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SukaDukaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $categories = ['Suka', 'Duka'];

        for ($i = 0; $i < 50; $i++) {
            DB::table('suka_duka_citas')->insert([
                'judul' => $faker->sentence(5),
                'description' => $faker->sentence(10),
                'detail' => $faker->sentence(15),
                'tanggal' => $faker->dateTimeThisYear(),
                'category' => $faker->randomElement($categories),
                'user_id' => $faker->numberBetween(1, 30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
