<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogActivityEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name = null;
    public $user_id = null;
    public $url = null;
    public $method = null;
    public $ip_address = null;
    public $user_agent = null;
    
    public function __construct($name,$user_id,$url, $method,$ip_address,$user_agent)
    {
        $this->name = $name;
        $this->user_id = $user_id;
        $this->url = $url;
        $this->method = $method;
        $this->ip_address = $ip_address;
        $this->user_agent = $user_agent;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
