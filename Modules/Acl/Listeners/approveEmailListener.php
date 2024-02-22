<?php

namespace Modules\Acl\Listeners;

use Illuminate\Support\Facades\Mail;
use Modules\Acl\Mail\approveMail;
use Illuminate\Contracts\Queue\ShouldQueue;

class approveEmailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        try {
            if (config('mail.from.address')) {
                Mail::to($event->data->email)->send(new approveMail($event->details));
            }
        }catch (\Exception $e) {
            ErrorLog($event->type,$e->getMessage(),$event->data->email);
        }
    }
}
