<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class StoreMessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Message $message;
    private int $UserId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message ,int $UserId)
    {
        $this->message = $message;
        $this->UserId = $UserId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
       // return new PrivateChannel('channel-name');

       return [
           new Channel('store_message' . $this->UserId)
       ];
    }
    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'store_message';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array 
     */
    public function broadcastWith()
    {
        return ['message' => response()->json($this->message->load('senderUser'))];
    }
}
