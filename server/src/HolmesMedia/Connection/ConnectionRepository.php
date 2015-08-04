<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 04/08/15
 * Time: 17:45
 */

namespace HolmesMedia\Connection;


class ConnectionRepository
{
    private $connections = array();

    public function addConnection(Connection $connection)
    {
        if (!isset($this->connections[$connection->getId()])) {
            $this->connections[$connection->getId()] = $connection;
        }

        return $this;
    }

    public function removeConnection($id)
    {
        if (isset($this->connections[$id])) {
            unset($this->connections[$id]);
        }
    }

    public function getConnection($id)
    {
        if (isset($this->connections[$id])) {
            return $this->connections[$id];
        } else {
            return null;
        }
    }
}