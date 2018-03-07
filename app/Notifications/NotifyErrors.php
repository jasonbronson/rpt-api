<?php

namespace App\Notifications;
use App\Popo\Errors;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;


class NotifyErrors extends Notification
{
    use Queueable;

    private $msg;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->subject('An Error occurred with RPT application')
                    ->error()
                    ->line("While handling something in the RPT application we encountered an error below.\n".print_r($this->msg,true) )
                    //->action('Notification Action', url('/'))
                    ->line('Programmer has been notified of this issue!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        //dd($notifiable);
        return [
            'err' => $this->error->msg
        ];
    }
}
