<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MailQueueController extends Controller
{

    private $user_id;

    /*
     * Constructor
     */
    public function __construct()
    {
        if (Auth::id()) {

            $this->user_id = Auth::id();

        } else {

            return Redirect::route('login')->withInput()->with('error message', 'Please Login to access restricted area.');
        }
    }

    /**
     * Authenicates user and adds job to priority queue
     *
     * @return void
     */
    public function sendJob()
    {

        $job = (new SendEmailJob($this->user_id))->onQueue('high');
        $this->dispatch($job);
        printf('[%s]', 'job queued');
    }
}
