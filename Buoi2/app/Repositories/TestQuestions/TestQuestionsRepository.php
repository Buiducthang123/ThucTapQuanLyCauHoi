<?php

namespace App\Repositories\TestQuestions;

use App\Models\TestQuestion;
use App\Repositories\BaseRepository;
use App\Repositories\Test\TestRepositoryInterface;
use mysql_xdevapi\Exception;

class TestQuestionsRepository extends BaseRepository implements TestRepositoryInterface
{
    public function getModel()
    {
        // TODO: Implement getModel() method.
        return TestQuestion::class;
    }

    function custom_sort($index_start,$index_end,$question_id,$test_id)
    {

        try {
            if ($index_start < $index_end) {

                $this->model->where('index', '>', $index_start)
                    ->where('index', '<=', $index_end)
                    ->decrement('index');
            } else {
                $this->model->where('index', '>=', $index_end)
                    ->where('index', '<', $index_start)
                    ->increment('index');
            }
            $a = $this->model->where('question_id', $question_id)->where('test_id',$test_id)->update(['index'=>$index_end]);
            return $a;

        } catch (\Exception $exception) {
            return false;
        }

    }


}
