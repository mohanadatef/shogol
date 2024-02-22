<?php

namespace Modules\Acl\Listeners;

use Illuminate\Support\Facades\Mail;
use Modules\Acl\Mail\NotificationMail;

class NotificationEmailListener
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
        if(config('mail.from.address'))
        {
            Mail::to($event->data->email)->send(new NotificationMail($event->details,$event->data));
        }
    }
}
