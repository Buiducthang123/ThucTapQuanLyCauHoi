<?php

namespace App\Services;

use App\Repositories\Result\ResultRepository;
use Illuminate\Support\Facades\Log;

class ResultService
{
    protected  $resultRepo;

    public function __construct(ResultRepository $repository)
    {
        $this->resultRepo = $repository;
    }

    function create($data = [])
    {

        $test_id = $data['test_id'];
        $user_id = $data['user_id'];
        $result = $this->resultRepo->find($test_id,$user_id);
        if ($result){
            $this->resultRepo->create($data);
        }
    }

    function update($data,$id)
    {
        return $this->resultRepo->update($data,$id);
    }

}
