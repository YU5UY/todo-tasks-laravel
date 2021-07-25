<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserTasks;
use App\Models\User;

class ResestTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Users:resetTasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset Tasks daily';

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
     * @return int
     */
    public function handle()
    {
        UserTasks::truncate();
        User::select("*")->update(["all_tasks" => 0 , "done_tasks" => 0]);
        return 0;
    }
}
