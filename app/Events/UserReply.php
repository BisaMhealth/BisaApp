<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;



class UserReply implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     * 
     * @return void
     */

    public $fmtReply;
    public $responseCount;
    public $fullName;
    public $messageDate;
    public $flag;
    public $quesId;
    public $responderType;
    public function __construct($fullName,$fmtReply,$responseCount,$messageDate,$flag,$quesId,$responderType)
    {
        $this->fmtReply = $fmtReply;
        $this->responseCount = $responseCount;
        $this->fullName =  $fullName;
        $this->messageDate = $messageDate;
        $this->flag        = $flag;
        $this->quesId      = $quesId;
        $this->responderType = $responderType;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //Subscribe to to Channel
        //return new PrivateChannel('channel-name');
        //return new PrivateChannel('private-user-chat-channel.'.$quesId);
    }

    // public function broadcastAs(){
    //     return 'question-reply';
    // }
}
