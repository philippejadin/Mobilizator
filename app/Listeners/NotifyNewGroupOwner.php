<?php

namespace App\Listeners;

use App\Events\GroupCreated;
use Notification;
use Auth;

class NotifyNewGroupOwner
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
    public function handle(GroupCreated $group)
    {
        Notification::send(Auth::user(), new \App\Notifications\NewGroup($group));
       
    }
}
