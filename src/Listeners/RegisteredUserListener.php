<?php
namespace Infinety\EmailConfirmation\Listeners;

use Illuminate\Auth\Events\Registered;
use Infinety\EmailConfirmation\Notifications\ConfirmEmailNotification;
use Infinety\EmailConfirmation\Satellite;
use Notification;

class RegisteredUserListener
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
     * @param  Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        Satellite::createUnconfirmed($event->user);
        $notificationClass = app(config('email-confirmation.notifiable_class', ConfirmEmailNotification::class));
        Notification::send($event->user, new $notificationClass($event->user));
    }
}
