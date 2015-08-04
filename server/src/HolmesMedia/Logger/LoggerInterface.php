<?php

namespace HolmesMedia\Logger;


use Ratchet\ConnectionInterface;

interface LoggerInterface
{
    public function logNewConnection(ConnectionInterface $connection);
    public function logClosedConnection(ConnectionInterface $connection);
    public function logError(ConnectionInterface $connection, \Exception $e);
}