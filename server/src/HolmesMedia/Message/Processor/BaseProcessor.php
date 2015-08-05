<?php

namespace HolmesMedia\Message\Processor;


use HolmesMedia\Connection\Connection;
use HolmesMedia\Message\Incoming\Message;
use HolmesMedia\Printer\PrinterInterface;

/**
 * Class BaseProcessor
 * @package HolmesMedia\Message\Processor
 */
class BaseProcessor
{
    /**
     * @var PrinterInterface
     */
    protected $printer;

    /**
     * BaseProcessor constructor.
     * @param PrinterInterface $printer
     */
    public function __construct(PrinterInterface $printer)
    {
        $this->printer = $printer;
    }


    /**
     * @param Message    $message
     * @param Connection $connection
     */
    public function process(Message $message, Connection $connection)
    {
        switch($message->getType()) {
            case 'HELLO': $this->processHelloMessage($message, $connection); break;
            default: $this->printer->printMessage($connection, $message); break;
        }
    }

    private function processHelloMessage(Message $message, Connection $connection)
    {
        $connection->setDeviceName($message->getContent()->getRawContent()[0]['name']);
    }
}