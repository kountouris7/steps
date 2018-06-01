<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = ['name', 'surname', 'package_week', 'amount', 'discount', 'price','month_id'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return static
     */
    public static function updateOrCreate(array $attributes, array $values = array())
    {
        $instance = static::firstOrNew($attributes);

        $instance->fill($values)->save();

        return $instance;
    }
}
