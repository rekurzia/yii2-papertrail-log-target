<?php

namespace Rekurzia\Log;

use yii\base\InvalidConfigException;
use yii\log\Target;
use Monolog\Handler\SyslogUdp\UdpSocket;

class PapertrailTarget extends Target
{
    /**
     * @var string
     */
    public $host;

    /**
     * @var int
     */
    public $port;

    /**
     * @var bool
     */
    public $includeContextMessage = false;

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
}
