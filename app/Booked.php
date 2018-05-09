<?php

namespace App;

trait Booked
{


    public function book()
    {
        $attributes = [
            'user_id'       => auth()->id(),
            'groupDay_time' => request('day_time'),
        ];

        if ( ! $this->bookings()->where($attributes)->exists()) {
            $this->bookings()->create($attributes);
        }
    }

    public function bookings()
    {
        return $this->hasMany(GroupUser::class, 'group_id');
    }

    public function isBooked()
    {
        return ! ! $this->bookings->where('user_id', auth()->id())->count();
    }


    public function getBookingsCountAttribute()
    {
        return $this->bookings->count();
    }

}
