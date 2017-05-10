<?php
namespace Infinety\EmailConfirmation\Traits;

use Infinety\EmailConfirmation\Models\Confirm;

trait EmailConfirmation
{
    /**
     * @return mixed
     */
    public function confirm()
    {
        return $this->hasOne(Confirm::class);
    }
}
