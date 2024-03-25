<?php

namespace App\Repositories\Result;

use App\Models\Result;
use App\Repositories\BaseRepository;

class ResultRepository extends BaseRepository implements ResultRepositoryInterface
{
    function getModel()
    {
        return Result::class;
    }

    function find($test_id,$user_id)
    {
        $result = $this->model->where('test_id', $test_id)
            ->where('user_id', $user_id)
            ->where('status', 0)
            ->first();
        if($result){
            return false;
        }
        return true;
    }

    function checkCorrectOption($data = [])
    {
        return $data;
    }

}
