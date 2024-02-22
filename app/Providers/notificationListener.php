<?php

namespace App\Providers;

use App\Providers\notificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Setting\Service\NotificationService;

class notificationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
 //todo move file to module -heba-
    /**
     * Handle the event.
     *
     * @param  \App\Providers\notificationEvent  $event
     * @return void
     */
    public function handle(notificationEvent $event)
    {
        $this->notificationService->sendNotification($event->users,$event->data,$event->type,$event->request);
    }
}
