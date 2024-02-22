<?php

namespace Modules\Acl\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class approveEmailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    //TODO make queue - test --heba--
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data,$details,$type)
    {
        $this->data=$data; //data of user
        $this->details=$details; // body email
        $this->type=$type;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
