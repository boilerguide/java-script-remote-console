<?php

namespace HolmesMedia\PhpServer;


use HolmesMedia\Connection\Connection;
use HolmesMedia\Connection\ConnectionRepository;
use HolmesMedia\Logger\LoggerInterface;
use HolmesMedia\Message\Incoming\Message;
use HolmesMedia\Message\Processor\BaseProcessor;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

/**
 * Class WebSocketRemoteConsoleDebugServer
 * @package HolmesMedia\PhpServer
 */
class WebSocketRemoteConsoleDebugServer implements MessageComponentInterface
{
    /**
     * @var BaseProcessor
     */
    private $messageProcessor;
    /**
     * @var ConnectionRepository
     */
    private $connectionRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * WebSocketRemoteConsoleDebugServer constructor.
     * @param BaseProcessor        $messageProcessor
     * @param ConnectionRepository $connectionRepository
     * @param LoggerInterface      $logger
     */
    public function __construct(BaseProcessor $messageProcessor, ConnectionRepository $connectionRepository, LoggerInterface $logger)
    {
        $this->messageProcessor = $messageProcessor;
        $this->connectionRepository = $connectionRepository;
        $this->logger = $logger;
    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn) {

        $connection = new Connection($conn->resourceId);
        $this->connectionRepository->addConnection($connection);
        $this->logger->logNewConnection($conn);
    }

    /**
     * @param ConnectionInterface $from
     * @param string $msg
     */
    public function onMessage(ConnectionInterface $from, $msg) {
        $message = new Message($msg);
        if ($connection = $this->connectionRepository->getConnection($from->resourceId)) {
            $this->messageProcessor->process($message, $connection);
        }
    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn) {
        $this->connectionRepository->removeConnection($conn->resourceId);
        $this->logger->logClosedConnection($conn);
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Exception $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e) {
        $this->logger->logError($conn, $e);
    }


}