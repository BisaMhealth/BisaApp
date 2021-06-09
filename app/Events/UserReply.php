<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Core\MakesApiRequest;


class UserReply implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels,MakesApiRequest;

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
    public $userToken;
    public function __construct($fullName,$fmtReply,$responseCount,$messageDate,$flag,$quesId,$responderType,$userToken)
    {
        $this->fmtReply = $fmtReply;
        $this->responseCount = $responseCount;
        $this->fullName =  $fullName;
        $this->messageDate = $messageDate;
        $this->flag        = $flag;
        $this->quesId      = $quesId;
        $this->responderType = $responderType;
        $this->userToken = $userToken;
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
        return new Channel('user-chats-channel');
    }

    public function broadcastAs(){
        return 'question-reply';
    }
}
