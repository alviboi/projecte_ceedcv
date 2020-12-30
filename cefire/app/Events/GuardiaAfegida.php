<?php

namespace App\Events;

// use Illuminate\Broadcasting\Channel;
// use Illuminate\Broadcasting\InteractsWithSockets;
// use Illuminate\Broadcasting\PresenceChannel;
// use Illuminate\Broadcasting\PrivateChannel;
// use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
// use Illuminate\Foundation\Events\Dispatchable;
// use Illuminate\Queue\SerializesModels;

use Illuminate\Broadcasting\PrivateChannel;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;


class GuardiaAfegida implements ShouldBroadcast
{

    public $guardia=array();
    public $user;
    public $m;


    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user,$guardia,$m)
    {
        //
        $this->user = $user;
        $this->guardia = $guardia;
        $this->m = $m;;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('guardies');
        return ['cefire'];
    }

    public function broadcastAs() {
        return 'GuardiaAfegida'.$this->guardia['data'].$this->m;
    }
}
