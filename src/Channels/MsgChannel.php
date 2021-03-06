<?php

namespace Zsardarov\Msg\Channels;

use Illuminate\Notifications\Notification;
use Zsardarov\Msg\MsgService;

class MsgChannel
{
    private $sender;

    public function __construct(MsgService $sender)
    {
        $this->sender = $sender;
    }

    public function send($notifiable, Notification $notification)
    {
        $text = $notification->toSms();
        $number = $notifiable->toMsg();

        $this->sender->send($number, $text);
    }
}
