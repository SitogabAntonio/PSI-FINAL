<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class WartaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('warta_jemaats')->insert([
                'judul' => $faker->sentence(6),
                'penkotbah' => $faker->sentence(10),
                'judul_renungan' => $faker->sentence(20),
                'isi_renungan' => $faker->sentence(100),
                'deskripsi_pengumuman' => $faker->sentence(100),
                'tanggal' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'user_id' => $faker->numberBetween(6, 30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
