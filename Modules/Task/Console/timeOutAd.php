<?php

namespace Modules\Task\Console;

use Illuminate\Console\Command;
use Modules\Task\Service\AdService;

class timeOutAd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'command:timeOutAd';

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
    public function __construct(AdService $service)
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
        if (getValueSetting('time_out_ad') != 0) {
            $this->service->timeOut();
        }
    }
}
