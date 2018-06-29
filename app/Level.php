<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $fillable =['level'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }
}
