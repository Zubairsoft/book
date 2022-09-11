<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddBook extends Notification implements ShouldQueue
{
    use Queueable;
public $book;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($book)
    {
        //
        $this->book=$book;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject("add new book")
                    ->line(" add new book by".$this->book->user->name)
                    ->action('click for show book', url('/'))
             ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }
    public function toDataBase($notifiable)
    {
        return [
           "book_id"=> $this->book->id,
           "book_name"=> $this->book->book_name,
           "description"=> $this->book->description,
        ];
    }
}
