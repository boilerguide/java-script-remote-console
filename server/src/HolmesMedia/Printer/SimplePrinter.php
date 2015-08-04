<?php

namespace HolmesMedia\Printer;


use HolmesMedia\Connection\Connection;
use HolmesMedia\Message\Incoming\Message;

class SimplePrinter implements PrinterInterface
{
    private $template = "[%s][%s][%s] %s\n";

    public function printMessage(Connection $connection, Message $message)
    {
        $output = sprintf(
            $this->template,
            $connection->getId(),
            $connection->getDeviceName(),
            $message->getType(),
            $message->getContent()
        );

        echo $output;
    }
}