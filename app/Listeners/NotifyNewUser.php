<?php

namespace App\Listeners;

use Notification;
use Auth;

class NotifyNewUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param GroupCreated $event
     *
     * @return void
     */
    public function handle()
    {
        Notification::send(Auth::user(), new \App\Notifications\NewUser());
       
    }
}
