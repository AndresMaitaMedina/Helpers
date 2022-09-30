<?php

namespace App\Events;
use App\User;
use App\Message;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $usuario;
    public $mensaje;

    public function __construct($usuario, $mensaje)
    {
        $this->usuario = $usuario;
        $this->mensaje = $mensaje;
    }

    public function broadcastOn()
    {
        return 'chat-channel';
    }

    public function broadcastAs()
    {
        return "chat-event";
    }
}