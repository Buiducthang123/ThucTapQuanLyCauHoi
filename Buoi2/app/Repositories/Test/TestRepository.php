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

    function custom_sort($test_id,$data=[])
    {
        $test = $this->model->find($test_id);

        if ($test) {
            try {
                $updates = [];
                foreach ($data as $value) {
                    $updates[$value->question_id] = $value->index;
                }
                foreach ($updates as $key => $value) {
                    $test->questions()->updateExistingPivot($key,['index'=>$value]);
                }
                return $updates;
            } catch (Exception $e) {
                return false;
            }
        }
        return false;
    }

//    function get_random_questions($test_id)
//    {
//        $test = $this->model->find($test_id);
//        if ($test) {
//            return $test->questions()->inRandomOrder()->limit(40)->get();
//        }
//        return false;
//    }
}
