<?php
namespace Infinety\EmailConfirmation\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Infinety\EmailConfirmation\Models\Confirm;
use Infinety\EmailConfirmation\Notifications\ConfirmEmailNotification;
use Infinety\EmailConfirmation\Requests\ResendEmail;
use Infinety\EmailConfirmation\Satellite;
use Notification;

class ConfirmController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function postConfirm($hash)
    {
        if (auth()->check() && auth()->user()->confirm->is_confirmed === true) {
            session()->flash('confirm_mail', 'activated');

            return redirect('/');
        }
        
        $confirm = Confirm::where('hash', $hash)->first();


        if (!$confirm) {
            session()->flash('confirm_mail', 'not_found');

            return redirect('/');
        }

        $user = $confirm->user;

        if (!$user) {
            session()->flash('confirm_mail', 'user-not-found');

            return redirect('/');
        } else {
            $confirm = $user->confirm;
            if (!empty($confirm) && $confirm->hash == $hash) {
                $confirm->is_confirmed = true;
                $confirm->hash = null;
                $confirm->save();

                Auth::loginUsingId($user->id);

                return redirect(route('confirm.successfull'));
            } else {
                return redirect()->back()->withErrors([trans('email-confirmation.view.confirm.not-found')]);
            }
        }

        return redirect()->back()->withErrors([trans('email-confirmation.view.confirm.something-wrong')]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function postRepeatConfirm(ResendEmail $request)
    {
        $email = $request->get('email');
        if (auth()->check()) {
            $User = auth()->user();
        } else {
            $User = User::where('email', $email)->first();
        }
        if (!empty($User) && $User->email == $email) {
            $Confirm = $User->confirm;
            $Confirm->save([
                'is_confirmed' => false,
                'hash'         => Satellite::makeHash(23),
            ]);
            Notification::send($User, new ConfirmEmailNotification($User));

            return redirect(route('confirm.re-sent'));
        } else {
            return redirect()->back()->withErrors([trans('email-confirmation.view.confirm.not-found')]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getConfirm($hash)
    {
        if (auth()->check() && auth()->user()->confirm->is_confirmed === true) {
            session()->flash('confirm_mail', 'activated');

            return redirect('/');
        } else {
            return view('auth.confirm.email', ['hash' => $hash]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRepeatConfirm()
    {
        return view('auth.confirm.repeat');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSuccessfull()
    {
        return view('auth.confirm.successfull');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getResent()
    {
        return view('auth.confirm.re-sent');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getWarning()
    {
        return view('auth.confirm.warning');
    }
}
