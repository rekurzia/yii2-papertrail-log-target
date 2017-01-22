<?php

namespace Rekurzia\Log;

use yii\base\InvalidConfigException;
use yii\log\Target;
use Monolog\Handler\SyslogUdp\UdpSocket;

class PapertrailTarget extends Target
{
    /**
     * Host to connect
     * @var string
     */
    public $host;

    /**
     * Port to connect
     * @var int
     */
    public $port;

    /**
     * Whether to include also context message. Defaults to false.
     * @var bool
     */
    public $includeContextMessage = false;

    /**
     * A PHP callable that returns a string to be prefixed to every exported message.
     * Useful when standard prefix is not enough. @see Target::prefix
     * @var callable
     */
    public $additionalPrefix;

    /**
     * @var UdpSocket
     */
    private $_socket;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->host === null) {
            throw new InvalidConfigException('The "host" property must be set.');
        }
        if ($this->port === null) {
            throw new InvalidConfigException('The "port" property must be set.');
        }
        if ($this->additionalPrefix !== null && !is_callable($this->additionalPrefix)) {
            throw new InvalidConfigException('The "additionalPrefix" property must be callable.');
        }
    }

    /**
     * Gets UdpSocket instance
     * @return UdpSocket
     */
    public function getUdpSocket()
    {
        if ($this->_socket === null) {
            $this->_socket = new UdpSocket($this->host, $this->port);
        }

        return $this->_socket;
    }

    /**
     * @inheritdoc
     */
    public function export()
    {
        foreach ($this->messages as $message) {
            $this->getUdpSocket()->write($this->formatMessage($message));
        }
        $this->getUdpSocket()->close();
    }

    /**
     * @inheritdoc
     */
    protected function getContextMessage()
    {
        return $this->includeContextMessage ? parent::getContextMessage() : '';
    }

    /**
     * @inheritdoc
     */
    public function getMessagePrefix($message)
    {
        if ($this->additionalPrefix !== null) {
            return '[' . call_user_func($this->additionalPrefix) . ']' . parent::getMessagePrefix($message);
        } else {
            return parent::getMessagePrefix($message);
        }
    }
}
