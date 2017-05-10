<?php

namespace Infinety\EmailConfirmation\Models;

use Illuminate\Database\Eloquent\Model;

class Confirm extends Model
{
    /**
     * @var string
     */
    protected $table = 'email_confirmations';
    /**
     * @var array
     */
    protected $fillable = [
        'is_confirmed',
        'hash',
    ];
    /**
     * @var array
     */
    protected $touches = [
        'user',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('model', 'App\User'));
    }
}
