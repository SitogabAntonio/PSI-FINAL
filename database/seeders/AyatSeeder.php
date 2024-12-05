<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AyatSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('ayat_harians')->insert([
                'tema' => $faker->randomElement([
                    'Kasih Tuhan',
                    'Keselamatan',
                    'Pengampunan',
                    'Kehidupan Baru',
                    'Iman dan Harapan',
                    'Perseverance dalam Cobaan',
                    'Doa dan Penyembahan',
                    'Hikmat Ilahi',
                    'Berkat dan Penyertaan Tuhan',
                    'Pemulihan dan Penghiburan'
                ]),
                'ayat' => $faker->randomElement([
                    'Yohanes 3:16',
                    'Mazmur 23:1',
                    'Filipi 4:13',
                    '1 Korintus 13:4-7',
                    'Yeremia 29:11',
                    'Roma 8:28',
                    'Yesaya 41:10',
                    'Mazmur 91:1-2',
                    'Amsal 3:5-6',
                    'Matius 6:33'
                ]),
                'isi_ayat' => $faker->sentence(15),
                'detail' => $faker->sentence(10),
                'tanggal' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'user_id' => $faker->numberBetween(6, 30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
