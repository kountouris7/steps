<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];
    protected $fillable =[];


    public function path()
    {
        return "/booking/{$this->id}";
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function book()
    {
        $attributes = [
            'user_id' => auth()->id(),
        ];
        if ( ! $this->clients()->where($attributes)->exists()) {
            $this->clients()->attach(auth()->id());
        }
    }

    public function clients()
    {
        return $this->belongsToMany(User::class, 'group_users')
                    ->withTimestamps();
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
