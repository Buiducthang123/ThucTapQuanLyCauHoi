<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class SendMailController extends Controller
{
    //
    protected $userService;
    /**
     * Class constructor.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }




    public function index() {
        // $this->userService->sendMailBD();

    }
}
