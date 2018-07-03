<?php

namespace App\Console\Commands;

use App\Group;
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
        $groups    = Group::first();
        $newGroups = $groups->replicate()->save();
    }
}
