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

    protected $fillable =['user_id', 'group_id', 'groupDay_time'];

    public function path()
    {
        return "/booking/{$this->group_id}";
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lessons()
    {
        return $this->belongsTo(Lesson::class, 'group_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
