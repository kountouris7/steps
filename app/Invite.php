<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = [
        'email', 'token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
