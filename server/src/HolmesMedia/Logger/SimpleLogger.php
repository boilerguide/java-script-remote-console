<?php

namespace HolmesMedia\Logger;


use Ratchet\ConnectionInterface;

class SimpleLogger implements LoggerInterface
{

    public function logNewConnection(ConnectionInterface $connection)
    {
        printf ("New incoming connection [%s]\n", $connection->resourceId);
    }

    public function logClosedConnection(ConnectionInterface $connection)
    {
        printf ("Closed connection [%s]\n", $connection->resourceId);
    }

    public function logError(ConnectionInterface $connection, \Exception $e)
    {
        printf("ERROR: %s [%s] \n", $e->getMessage(), $connection->resourceId);
    }
}