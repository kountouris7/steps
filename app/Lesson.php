<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $fillable =['name'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function hasname()
    {
        return $this->hasOne(Lesson::class,'name');
    }
}
