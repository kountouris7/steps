<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    protected $fillable = [];

    public function subscribers()
    {
        return $this->hasMany(Subscriber::class);
    }
}
