<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Test;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Testing\Fakes\Fake;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        for ($i = 0; $i < 100; $i++) {
            Question::create([
                'Content' => $faker->sentence,
                'OptionA' => "Hiii",
                'OptionB' => $faker->word,
                'OptionC' => $faker->word,
                'OptionD' => $faker->word,
                'CorrectOption' => "Hiii"
            ]);
        }
    }
}
