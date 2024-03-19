<?php

namespace App\Services;

use App\Jobs\SendEmailJob;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Carbon;

class UserService{
    protected $userRepo;

    /**
     * Class constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepo = $userRepository;
    }

    function sendMailBD() {
        $users = $this->userRepo->getBD();
        foreach ($users as $value) {
            $bd = $value->Sn = Carbon::parse($value->Sn)->format('d/m/Y');
            $subject = "Chúc mừng sinh nhật";
            $body = "Chúc mừng sinh nhật ".$bd.$value->name;
            dispatch(new SendEmailJob($value->email,$subject,$body));
        }
    }


}
