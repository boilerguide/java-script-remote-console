<?php

use HolmesMedia\Connection\ConnectionRepository;
use HolmesMedia\Logger\SimpleLogger;
use HolmesMedia\Message\Processor\BaseProcessor;
use HolmesMedia\PhpServer\WebSocketRemoteConsoleDebugServer;
use HolmesMedia\Printer\SimplePrinter;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

require __DIR__ . '/../vendor/autoload.php';

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new WebSocketRemoteConsoleDebugServer(
                new BaseProcessor(new SimplePrinter()),
                new ConnectionRepository(),
                new SimpleLogger()
            )
        )
    ),
    8081
);

$server->run();