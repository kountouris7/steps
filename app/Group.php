<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use Booked;


    protected $with = ['bookings'];

}
