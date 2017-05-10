<?php

namespace Infinety\EmailConfirmation\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConfirmEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $url = url('/confirm/email/'.$notifiable->confirm->hash);

        return (new MailMessage())
            ->subject(trans('email-confirmation.email.subject'))
            ->greeting(trans('email-confirmation.email.greetings', ['name' => $notifiable->name]))
            ->line(trans('email-confirmation.email.message1'))
            ->line(trans('email-confirmation.email.message2'))
            ->line(trans('email-confirmation.email.message3'))
            ->action(trans('email-confirmation.email.action'), $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
