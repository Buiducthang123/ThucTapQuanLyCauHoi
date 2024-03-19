<?php

namespace App\Jobs;
use App\Mail\sendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $email,$subject,$body;
    public function __construct($email,$subject,$body)
    {
        $this->email= $email;
        $this->subject=$subject;
        $this->body = $body;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to($this->email)->send(new sendMail($this->subject,$this->body));
    }
}
