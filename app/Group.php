<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = [];

    //protected $dates = ['day_time'];

    public function scopeDayFilter($query, $day)
    {
        return $query->whereRaw("WEEKDAY(groups.day_time) =" . $day)
                     ->where('day_time', '>=', today())
                     ->orderBy('day_time');
    }

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

    public function book() //this is ignored
    {
       //$attributes = ['user_id' => auth()->id()];
       //if ( ! $this->clients()->where($attributes)->exists()) {
       //    $this->clients()->attach(auth()->id());
       //}
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

    public function attendance()
    {
        return $this->clients()->count();
    }

    public function capacity()
    {
        return $this->max_capacity;
    }

    public function sameDayBooked()
    {
        return $this->clients()->where('created_at', '=' . $this->day);
    }

    /**
     * @return string
     */
    public function today(): string
    {
        $today = Carbon::today()->now()->toDateString();

        return $today;
    }


}
