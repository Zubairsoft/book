<?php

namespace App\Listeners;

use App\Events\AddBook as EventsAddBook;
use App\Models\User;
use App\Notifications\AddBook as NotificationsAddBook;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

class AddBook
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
     * @param  object  $event
     * @return void
     */
    public function handle(EventsAddBook $book,EventsAddBook $user)
    {
        Notification::send($user,new NotificationsAddBook($book));
    }
}
