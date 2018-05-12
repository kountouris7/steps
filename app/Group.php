<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use Booked;

    protected $guarded = [];



    public function path()
    {
        return "/booking/{$this->id}";
    }

    public function owner()
    {
        return $this->belongsToMany(User::class, 'group_users');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

}
