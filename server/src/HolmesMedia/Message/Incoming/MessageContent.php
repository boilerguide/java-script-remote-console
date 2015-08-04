<?php

namespace HolmesMedia\Message\Incoming;


/**
 * Class MessageContent
 * @package HolmesMedia\Message\Incoming
 */
class MessageContent
{
    /**
     * @var mixed
     */
    private $rawContent;

    /**
     * @var string
     */
    private $processedContent;

    /**
     * @param mixed $rawContent
     */
    public function __construct($rawContent)
    {
        $this->rawContent = $rawContent;

        if (is_array($this->rawContent)) {
            $numItems = count($this->rawContent);
            $i = 0;
            foreach ($this->rawContent as $key => $val) {
                $this->processedContent .= $this->processContent($val);
                if(++$i !== $numItems) {
                    $this->processedContent .= ", ";
                }
            }
        } else {
            $this->processedContent = $rawContent;
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->processedContent;
    }

    private function processContent($data)
    {
        $r = '';

        if (is_string($data)) {
            $r = '"' . $data . '"';
        } elseif (is_array($data)) {
            $r .= '[';
            $numItems = count($data);
            $i = 0;
            foreach ($data as $k => $v) {
                $r .= $k . ' => ' . $this->processContent($v);
                if(++$i !== $numItems) {
                    $r .= ", ";
                }
            }
            $r .= ']';
        } else if (
            (!is_object( $data ) && settype( $data, 'string' ) !== false)
            || (is_object( $data ) && method_exists( $data, '__toString' ))
        ) {
            $r = (string)$data;
        }

        return $r;
    }

    /**
     * @return mixed
     */
    public function getRawContent()
    {
        return $this->rawContent;
    }
}