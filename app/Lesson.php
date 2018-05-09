<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function group()
    {
        return $this->belongsTo(Group::class, 'lesson_id');
    }
}
