<?php

namespace Infinety\EmailConfirmation\Events;

use App\User;
use Illuminate\Queue\SerializesModels;

class RegisteredUserEvent
{
    use SerializesModels;
    /**
     * @var $user
     */
    public $user;
    /**
     * Create a new event instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
