<?php
namespace Infinety\EmailConfirmation\Middleware;

use Closure;
use Infinety\EmailConfirmation\Notifications\ConfirmEmailNotification;
use Infinety\EmailConfirmation\Satellite;
use Notification;

/**
 * Class CatchUnconfirmed
 * @package Infinety\EmailConfirmation\Middleware
 */
class CatchUnconfirmed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param Activity $Activity
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('email-confirmation.catch_unconfirmed') === true) {
            if (auth()->check()) {

                if (auth()->user()->confirm) {

                    if (!auth()->user()->confirm->is_confirmed) {

                        if (null === auth()->user()->confirm->hash) {
                            auth()->user()->confirm->hash = Satellite::makeHash(23);
                            auth()->user()->confirm->save();
                            Notification::send(auth()->user(), new ConfirmEmailNotification(auth()->user()));
                        }

                        auth()->logout();

                        return redirect('/');
                    }
                } else {
                    Satellite::createUnconfirmed(auth()->user());
                    Notification::send(auth()->user(), new ConfirmEmailNotification(auth()->user()));

                    return redirect(route('confirm.warning'));
                }
            }
        }

        return $next($request);
    }
}
