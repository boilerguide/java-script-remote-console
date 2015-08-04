<?php

namespace HolmesMedia\Printer;


use HolmesMedia\Connection\Connection;
use HolmesMedia\Message\Incoming\Message;

interface PrinterInterface
{
    public function printMessage(Connection $connection, Message $message);
}