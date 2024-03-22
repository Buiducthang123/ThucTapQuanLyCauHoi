<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\TestService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    protected $testService;
    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    function index()
    {
        $tests = $this->testService->getAllTest();
        return view('User.index',compact(['tests']));
    }
}
