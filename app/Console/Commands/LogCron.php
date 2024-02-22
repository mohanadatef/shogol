<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Modules\Basic\Entities\Log;
use Modules\Basic\Service\LogService;

class LogCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LogService $service)
    {
        parent::__construct();
        $this->service =$service;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $logs =$this->service->findBy(new Request(),false,0,['where'=>['created_at'=>['<='=>[Carbon::now()->subWeek()]]]]);
        foreach($logs as $log){
            $log->delete();
        }
        return true;
    }
}
