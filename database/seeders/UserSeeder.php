<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $image_profile = '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';

        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Super Admin 1',
            'email' => 'superadmin1@gmail.com',
            'password' => bcrypt('123'),
            'image' => $image_profile,
            'domain' => Str::random(10),
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Super Admin 2',
            'email' => 'superadmin2@gmail.com',
            'password' => bcrypt('123'),
            'image' => $image_profile,
            'domain' => Str::random(10),
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        for ($i = 0; $i < 5; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'image' => $image_profile,
                'role_id' => 1,
                'domain' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        for ($i = 0; $i < 25; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'image' => $image_profile,
                'role_id' => 2,
                'domain' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
