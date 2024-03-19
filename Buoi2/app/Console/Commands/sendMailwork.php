<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\SendMailService;
use App\Services\UserService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;


class sendMailwork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     *
     */
    protected $sendMailS;


    protected $signature = 'app:send-mailwork';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sendMailService = app(UserService::class);
        $sendMailService->sendMailBD();
    }
}
