<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait Booked
{


    public function bookings()
    {
        return $this->hasMany(Group_user::class, 'group_id');
    }


    public function book()
    {
        $attributes = ['user_id' => auth()->id()];
        if (!$this->bookings()->where($attributes)->exists()){
            $this->bookings()->create($attributes);
        }
    }

    public function isBooked()
    {
        return !! $this->bookings->where('user_id', auth()->id())->count();
    }


    public function getBookingsCountAttribute()
    {
        return $this->bookings->count();
    }

}
