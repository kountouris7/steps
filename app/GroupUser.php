<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class GroupUser extends Model
{

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    protected $fillable =['user_id', 'group_id'];

    public function path()
    {
        return "/booking/{$this->group_id}";
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
