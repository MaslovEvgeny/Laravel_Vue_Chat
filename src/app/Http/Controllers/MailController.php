<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\QueueSenderEmail;

class MailController extends Controller
{
    public function index(Request $request)
    {

        $body = "В чате с '$request->name' - новое сообщение;";
        $qs = new QueueSenderEmail($body, $request->email);
        $this->dispatch($qs);
    }
}
