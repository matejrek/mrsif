<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Task;
use Carbon\Carbon;

class DeleteObsoleteTaskEntries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tasks table cleanup';

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
        //
        Task::where('datetime', '<', Carbon::now()->subDays(1))->each(function ($task) {
            $task->delete();
        });
        Task::where('completed', 1)->each(function ($task) {
            $task->delete();
        });
    }
}
