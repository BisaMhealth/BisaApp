<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class QuestionRead implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $allUnreadMessages;
    public $countAllQuestionsGlobal;
    public $userUnreadMessages;
    public function __construct($allUnreadMessages,$countAllQuestionsGlobal,$userUnreadMessages)
    {
        //
        $this->allUnreadMessages = $allUnreadMessages;
        $this->countAllQuestionsGlobal = $countAllQuestionsGlobal;
        $this->userUnreadMessages   = $userUnreadMessages;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
        return new Channel('update-notification-channel');
    }

     public function broadcastAs(){
        return 'question-read';
    }
}
