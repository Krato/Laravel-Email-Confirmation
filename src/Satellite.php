<?php
namespace Infinety\EmailConfirmation;

use App\User;

class Satellite
{
    /**
     * @return void
     */
    public static function makeHash($length = 23)
    {
        return str_random($length);
    }

    /**
     * @return void
     */
    public static function createUnconfirmed(User $user)
    {
        $user->confirm()->create([
            'is_confirmed' => false,
            'hash'         => self::makeHash(23),
        ]);
    }
}
