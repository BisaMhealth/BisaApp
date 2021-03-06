<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class DoctorReply implements ShouldBroadcast
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
    // public function broadcastOn()
    // {
    //     return new Channel('doctor-reply');
    // }

    // public function broadcastAs(){
    //     return 'doctor-question-reply';
    // }
}
