<?php

namespace App\Events;

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class MessageSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    /**
     * Create a new event instance.
     *
     * @param  string  $message
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;

        // Initialize a new ElephantIO client
        $client = new Client(new Version2X('http://localhost:3000', [
            'headers' => [
                'X-My-Header: websocket rocks',
                'Authorization: Bearer 12b3c4d5e6f7g8h9i'
            ]
        ]));

        // Connect to the socket server
        $client->initialize();

        // Emit the message to the 'newMessage' channel
        $client->emit('newMessage', ['message' => $message]);

        // Close the connection
        $client->close();
    }
}
