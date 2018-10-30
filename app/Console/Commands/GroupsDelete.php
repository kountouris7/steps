<?php

namespace App\Console\Commands;

use App\Email;
use App\Group;
use App\Invite;
use App\Mail\SendCronNotif;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class GroupsDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'groups:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Old Groups Deleted';

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
        $lastWeekDate = Carbon::today()->subWeek()->toDateString(); //this will run every Saturday
        $today        = Carbon::today()->toDateString();

        Group::whereBetween('day_time', [$lastWeekDate, $today])->delete();
        Mail::to('kountouris7@gmail.com')->send(new SendCronNotif($email));
        return info('Old groups have been deleted');

    }
}