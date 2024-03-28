<?php

namespace App\Repositories\Test;

use App\Models\Test;
use App\Models\TestQuestion;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Log;
use PHPUnit\Event\Exception;

class TestRepository extends BaseRepository implements TestRepositoryInterface
{

    function getModel()
    {
        return Test::class;
    }

    function show($id)
    {
        $test = $this->model->find($id);
        if ($test) {
            return $test->questions()->orderBy('pivot_index', 'asc')
                ->paginate(40);
        }
        return false;
    }

    function getQuestion($id)
    {
        $test = $this->model->find($id);
        if ($test) {
            return $test->questions()->latest()->get();
        }
        return false;
    }
    function count_score($data = [],$test_id)
    {
        $count_correct = 0;
        $test = $this->model->find($test_id);
        $count_question =0;
        if ($test) {
            $count_question=$test->questions()->count();
            foreach ($data as $key => $value) {
                $question = $test->questions()->where('questions.id',$key)
                    ->where('CorrectOption', $value)
                    ->get();
                if (!$question->isEmpty()) {
                    $count_correct++;
                }
            }
        }
        $score = 10/$count_question *$count_correct;
        $score = round($score,2);

        $result = [
            'score'=>$score,
            'correct_question'=>$count_correct,
            'questions'=>$count_question,
            'status'=>true,
            'answers'=>($data),
        ];
        return $result;
    }
}
