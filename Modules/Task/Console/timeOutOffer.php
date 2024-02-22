<?php

namespace Modules\Task\Console;

use Illuminate\Console\Command;
use Modules\Task\Service\OfferService;

class timeOutOffer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'command:timeOutOffer';

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
    public function __construct(OfferService $service)
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
        if (getValueSetting('time_out_offer') != 0) {
            $this->service->timeOut();
        }
    }
}
