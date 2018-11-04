<?php

namespace App\Console\Commands;

use App\Email;
use App\Group;
use App\GroupUser;
use App\Mail\DeleteBookings;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class BookingsDelete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Old Bookings deleted';

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
        $groups =  Group::with('clients')
                        ->where('day_time', '<' , today())
                        ->get();

        foreach($groups as $group){
            foreach ($group->clients as $booking){
                $booking->pivot->delete();
            }
        }
        Mail::to('kountouris7@gmail.com')->send(new DeleteBookings($email));
        return info('Old bookings have been deleted');
    }
}
