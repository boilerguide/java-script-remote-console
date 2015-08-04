<?php


namespace HolmesMedia\Message\Incoming;


class Message
{
    private $type;
    private $content;

    /**
     * Message constructor.
     *
     * @param string $message
     */
    public function __construct($message)
    {
        $decoded = json_decode($message, true);
        $this->type = strtoupper($decoded['type']);
        $this->content = new MessageContent($decoded['data']);
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return MessageContent
     */
    public function getContent()
    {
        return $this->content;
    }
}