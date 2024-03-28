<?php

namespace App\Repositories\Result;

use App\Models\Result;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

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

    function showDetail($result_id)
    {

        $test = Auth::user()->tests()->withPivot('id')->wherePivot('id', $result_id)->first();
        if (!$test) {
            return response()->json(['message' => 'Không tìm thấy kết quả bài kiểm tra'], 404);
        }

        $questions = $test->questions()->get();
        $answers_user = json_decode($test->pivot->answers, true);
//        dd($answers_user);
        return [
            'questions' => $questions,
            'answers_user' => $answers_user,
            'test'=>$test
        ];
    }



}
