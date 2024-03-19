<?php

namespace App\Repositories\Test;
use App\Models\Test;
use App\Repositories\BaseRepository;

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
            return $test->questions()->orderBy('pivot_created_at', 'desc')
            ->paginate(8);
        }
        return false;
    }

    function getQuestion($id) {
        $test = $this->model->find($id);
        if ($test) {
            echo("ahahah");
           ;
            return $test->questions()->latest()->get();
        }
        return false;
    }





}
