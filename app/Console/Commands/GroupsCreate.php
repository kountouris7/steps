<?php

namespace App\Console\Commands;

use App\Email;
use App\Group;
use App\Mail\SendGroupUpdateEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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
     * @param Email $email
     *
     * @return mixed
     */
    public function handle(Email $email)
    {

        $lastWeekDate = Carbon::today()->subWeek()->toDateString(); //this will run every Friday
        $groups       = Group::with('lesson')
                             ->where('day_time', '>', $lastWeekDate)
                             ->get();

        foreach ($groups as $group) {
            $newGroups           = $group->replicate();
            $newGroups->day_time = Carbon::parse($newGroups->day_time)->copy()->addWeek(1);
            $newGroups->save();
        }

        Mail::to('kountouris7@gmail.com')->send(new SendGroupUpdateEmail($email));

        return info('New classes created');
    }
}
