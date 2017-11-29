<?php

namespace App\Listeners;

use App\Notifications\PostPublished;
use Illuminate\Support\Facades\Notification;
use App\User;

use App\Events\PostCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUsersAboutNewPost
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
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        //var_dump("post creado");
        $users = User::all();
        Notification::send($users, new PostPublished($event->post));
    }
}
