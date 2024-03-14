<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserSaved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $addresses;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, array $addresses)
    {
        $this->user      = $user;
        $this->addresses = $addresses;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn() : array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
