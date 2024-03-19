<?php

namespace App\Http\Controllers;;

use App\Jobs\SendEmailJob;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Mail\sendMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    //
    protected $userRepo;
    /**
     * Class constructor.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepo = $userRepository;
    }
    function index()
    {

    }
}
