<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i=1; $i <11 ; $i++) {
            # code...
            User::create(
                [
                    'name'=>$faker->name(),
                    'email'=>$faker->email(),
                    'sn'=>$faker->date(),
                    'password'=>Hash::make('12345678')
                ]
                );
        }
        //
        User::create(
            [
                'name'=>$faker->name(),
                'email'=>'winnerbui0803@gmail.com',
                'sn'=>$faker->date(),
                'password'=>Hash::make('12345678'),
                'role_id'=>2,
            ]
        );
    }
}
