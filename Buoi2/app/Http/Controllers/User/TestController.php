<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\ResultService;
use App\Services\TestService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    //
    protected $testService;
    protected $resultService;

    public function __construct(TestService $testService, ResultService $resultService)
    {

        $this->testService = $testService;
        $this->resultService = $resultService;
    }

    function index($id)
    {
        $user = \auth()->user();
        $test = $user->tests()
            ->where('test_id', $id)
            ->where('status', '0')
            ->whereNull('score')
            ->with('questions')
            ->first();
        if ($test) {
            $questions = $test->questions;
            $result = $test->pivot;
            return view('User.test', compact(['questions', 'test', 'result']));
        }
        return ("Khong co");
    }


    function count_score(Request $request)
    {

        $data = $request->all();
        $test_id = $data["test_id"];
        $result_id = $data["result_id"];
        unset($data['_token']);
        unset($data['test_id']);
        unset($data['result_id']);
        return $this->testService->count_score($data, $test_id,$result_id);
    }
}
