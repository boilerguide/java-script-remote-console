<?php

namespace HolmesMedia\Printer;


use HolmesMedia\Connection\Connection;
use HolmesMedia\Message\Incoming\Message;
use HolmesMedia\Printer\Colors\Colors;

/**
 * Class ColorfulPrinter
 * @package HolmesMedia\Printer
 */
class ColorfulPrinter implements PrinterInterface
{
    /**
     * @var Colors
     */
    private $colorsRepository;
    /**
     * @var string
     */
    private $template = "[%s][%s][%s] %s\n";

    /**
     *
     */
    public function __construct()
    {
        $this->colorsRepository = new Colors();
    }

    /**
     * @param Connection $connection
     * @param Message    $message
     */
    public function printMessage(Connection $connection, Message $message)
    {
        $output = sprintf(
            $this->template,
            $connection->getId(),
            $connection->getDeviceName(),
            $this->colorsRepository->getColoredString(
                $message->getType(),
                $this->getColorForType(
                    $message->getType()
                )
            ),
            $message->getContent()
        );

        echo $output;
    }

    /**
     * @param $type
     * @return string
     */
    private function getColorForType($type)
    {
        switch(strtoupper($type)) {
            case 'ERROR': return 'red'; break;
            case 'INFO': return 'light_blue'; break;
            case 'WARN': return 'yellow'; break;
            case 'LOG': return 'light_green'; break;
            default: return 'white'; break;
        }
    }
}