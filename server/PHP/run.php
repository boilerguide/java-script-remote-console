<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 03/08/15
 * Time: 17:15
 */
use Ratchet\ConnectionInterface;
use Ratchet\Http\HttpServer;
use Ratchet\MessageComponentInterface;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

require __DIR__ . '/vendor/autoload.php';

class DebugServer implements MessageComponentInterface {
    public function onOpen(ConnectionInterface $conn) {
        echo "Incoming connection\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $msg = json_decode($msg, true);
        echo $msg['type'] . ": ";
        foreach ($msg["data"] as $i) {
            echo "[";
            print_r($i);
            echo "] ";
        }
        echo "\n";
    }

    public function onClose(ConnectionInterface $conn) {
        echo "Connection closed\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "ERROR\n";
    }
}

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new DebugServer()
        )
    ),
    8081
);

$server->run();