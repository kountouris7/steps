<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use Booked;


    protected $with = ['bookings'];
    /**
     * A Group has an owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
