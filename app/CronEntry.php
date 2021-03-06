<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CronEntry extends Model
{
    protected $primaryKey = 'command';

    protected $fillable = ['command', 'next_run', 'last_run'];

    /**
     * returns true every seven days
     *
     * @param $command
     * @param $minutes
     *
     * @return bool
     */
    public static function shouldIRun($command, $minutes)
    {
        $cron = CronEntry::find($command);
        $now  = Carbon::now();
        if ($cron && $cron->next_run > $now->timestamp) {
            return false;
        }
        CronEntry::updateOrCreate(
            ['command' => $command],
            [
                'next_run' => Carbon::now()->addMinutes($minutes)->timestamp,
                'last_run' => Carbon::now()->timestamp,
            ]
        );

        return true;
    }

    public static function updateOrCreate(array $attributes, array $values = [])
    {
        $instance = static::firstOrNew($attributes);

        $instance->fill($values)->save();

        return $instance;
    }
}

