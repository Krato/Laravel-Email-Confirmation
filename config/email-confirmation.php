<?php

return [
    'enabled'           => true,

    'route_prefix'      => 'confirm',

    'catch_unconfirmed' => true,

    'notifiable_class'  => \ITB\LEC\Notifications\ConfirmEmailNotification::class,

];
