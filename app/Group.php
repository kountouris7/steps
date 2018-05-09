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
    /**
     * A Group has an owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

}
