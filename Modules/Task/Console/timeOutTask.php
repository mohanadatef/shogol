<?php

namespace Modules\Task\Console;

use Illuminate\Console\Command;
use Modules\Task\Service\TaskService;

class timeOutTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'command:timeOutTask';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TaskService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (getValueSetting('time_out_task') != 0) {
            $this->service->timeOut();
        }
    }
}
