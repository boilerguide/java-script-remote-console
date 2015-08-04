<?php
/**
 * Created by PhpStorm.
 * User: adrian
 * Date: 04/08/15
 * Time: 17:46
 */

namespace HolmesMedia\Connection;


class Connection
{
    private $id;
    private $deviceName;

    /**
     * Connection constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDeviceName()
    {
        return $this->deviceName !== null ? $this->deviceName : 'unknown';
    }

    /**
     * @param string $deviceName
     *
     * @return Connection
     */
    public function setDeviceName($deviceName)
    {
        $this->deviceName = $deviceName;
        return $this;
    }


}