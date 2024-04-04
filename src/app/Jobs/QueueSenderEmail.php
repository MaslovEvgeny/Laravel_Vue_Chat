<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\MessageMail;
use Illuminate\Support\Facades\Mail;

class QueueSenderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mess, $toEmail;

    public function __construct($mess, $toEmail)
    {
        $this->mess = $mess;
        $this->toEmail = $toEmail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subject = 'Вам пришло новое сообщение!';
        $toEmail = $this->toEmail;
        $mm = new MessageMail($subject, $this->mess);
        Mail::to($toEmail)->send($mm);
    }
}
