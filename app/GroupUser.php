<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GroupUser extends Model
{
    use SoftDeletes;
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];
    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'group_id'];

    public function path()
    {
        return "/booking/{$this->group_id}";
    }

    public function client()
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
