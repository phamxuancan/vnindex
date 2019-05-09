<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PullDatas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:pulldata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull data from website';

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
        echo (123);
        //
    }
}
