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

        $this->testService= $testService;
        $this->resultService= $resultService;
    }

    function index($id)
    {
        $user = \auth()->user();
        $test = $user->tests()
            ->where('test_id',$id)
            ->where('status', '0')
            ->whereNull('scores')
            ->with('questions')
            ->first();
        if($test){
            $questions = $test->questions;
            $result = $test->pivot;
            return view('User.test', compact(['questions','test','result']));
        }
        return ("Khong co");
    }


    function checkCorrectOption(Request $request)
    {
        return $request->all();
    }
}
