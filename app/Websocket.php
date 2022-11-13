<?php
namespace App;
use App\Models\OldMessage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Websocket implements MessageComponentInterface {
    protected $clients, $chats, $users, $users_name;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $msg = json_decode($msg);
        if ($msg->message == 'new chat') {
            $this->chats[$msg->value][$from->resourceId] = $from;
            $this->users[$from->resourceId] = $msg->value;
            $this->users_name[$msg->value][$from->resourceId] = $msg->user;
            $users = [];
            foreach ($this->users_name[$msg->value] as $user) {
                $users[] = $user;
            }
            $message = ['message' => 'connection', 'users' => $users];
            foreach ($this->chats[$msg->value] as $client) {
                $client->send(json_encode($message));
            }
            dump($users);
        }
        elseif ($msg->message = 'new message') {
            $chat = $this->users[$from->resourceId];
            $i = true;
            foreach ($this->chats[$chat] as $client) {
                $message = ['message' => 'message', 'value' => $msg->value,
                    'user' => $this->users_name[$chat][$from->resourceId]];
                if ($i) {
                    $user_id = User::where('name_surname', $message['user'])->get()[0]['id'];
                    OldMessage::insert(['value' => $message['value'], 'user_id' => $user_id, 'chat_id' => $chat]);
                }
                $i = false;
                $client->send(json_encode($message));
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);
        $chat = $this->users[$conn->resourceId];
        unset($this->chats[$chat][$conn->resourceId]);
        unset($this->users[$conn->resourceId]);
        unset($this->users_name[$chat][$conn->resourceId]);

        $users = [];
        foreach ($this->users_name[$chat] as $user) {
            $users[] = $user;
        }
        $message = ['message' => 'connection', 'users' => $users];
        foreach ($this->chats[$chat] as $client) {
            $client->send(json_encode($message));
        }
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

}
