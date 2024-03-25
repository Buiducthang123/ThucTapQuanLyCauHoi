<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Test;
use App\Models\TestQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Testing\Fakes\Fake;

class TestQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = Faker::create();
        $questions_id =  Question::pluck('id');
        $tests_id = Test::pluck('id');

        for ($i=0; $i <30 ; $i++) {
             TestQuestion::create([
                'test_id' => 1,
                'question_id' => $faker->randomElement($questions_id),
                'index'=>$i,
            ]);
        }
        for ($i=0; $i <30 ; $i++) {
            TestQuestion::create([
                'test_id' => 2,
                'question_id' => $faker->randomElement($questions_id),
                'index'=>$i,
            ]);
        }
    }
}
