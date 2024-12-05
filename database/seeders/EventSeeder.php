<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emptyBase64Image = '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';

        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            DB::table('events')->insert([
                'event_name' => $faker->randomElement([
                    'Kebaktian Minggu',
                    'Perayaan Natal',
                    'Paskah Bersama',
                    'Ibadah Jumat Agung',
                    'Pelayanan Doa Malam',
                    'Retreat Rohani',
                    'Seminar Kepemimpinan Kristen',
                    'Pelayanan Sosial',
                    'Ibadah Pemuda',
                    'Pertemuan Doa'
                ]),
                'event_description' => $faker->sentence(15),
                'event_location' => $faker->address,
                'event_start_date' => $faker->dateTimeBetween('-1 months', '+1 months'),
                'event_end_date' => $faker->dateTimeBetween('+1 months', '+2 months'),
                'event_image' => $emptyBase64Image,
                'user_id' => $faker->numberBetween(6, 30),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
