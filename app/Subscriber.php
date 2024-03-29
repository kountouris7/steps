<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable =
        [
            'name',
            'surname',
            'email',
            'package_week',
            'amount',
            'discount',
            'price',
            'month',
        ];

    protected $dates = ['month'];

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param  array $attributes
     * @param  array $values
     *
     * @return static
     */
    public static function updateOrCreate(array $attributes, array $values = [])
    {
        $instance = static::firstOrNew($attributes);

        $instance->fill($values)->save();

        return $instance;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'subscription_id' ,'');
    }

    public function invitations()
    {
        return $this->hasMany(Invite::class);
    }
}
