<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'default'; //instead of hard-coding the type values into our factory we used class constants

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'subscription_id',
        'token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'name',
        'type',
        'email',
        'password',
        'remember_token',
    ];

    //protected $with = ['groups'];

    public function isAdmin()
    {
        return $this->type === self::ADMIN_TYPE;
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_users');
    }

    public function subscription()
    {
        return $this->hasOne(Subscriber::class, 'email', 'email');
    }

    public function invite()
    {
        return $this->hasOne(Invite::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }
}
