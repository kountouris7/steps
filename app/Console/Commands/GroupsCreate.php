<?php

namespace App\Console\Commands;

use App\Group;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GroupsCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'groups:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'New Groups Created';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lastWeek = Carbon::today()->subWeek()->toDateString(); //this will run every sunday
        $groups   = Group::with('lesson')
                         ->where('day_time', '>', $lastWeek)
                         ->get();

        foreach ($groups as $group) {
            $newGroups      = $group->replicate();
            $newGroups->day_time = Carbon::parse($group->day_time)->addWeek(1);
            $newGroups->save();
        }
       return info('New classes created');
    }
}
