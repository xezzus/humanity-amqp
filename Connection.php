<?php
namespace amqp;

class Connection
{
    public $host;
    public $login;
    public $password;
    public $port;
    public $vhost = '/';
    private $amqpConnection;
    private $amqpChannel;

    public function getAmqpConnection()
    {
        if ($this->amqpConnection === null) {
            $this->amqpConnection = new \AMQPConnection();
            $this->amqpConnection->setLogin($this->login);
            $this->amqpConnection->setPassword($this->password);
            $this->amqpConnection->setVhost($this->vhost);
            $this->amqpConnection->connect();
            $this->amqpChannel = New \AMQPChannel($this->amqpConnection);
        }
    }

    public function exchange($name)
    {
        $this->getAmqpConnection();
        return new Message($this->amqpConnection, $this->amqpChannel, $name);
    }

    public function disconnect()
    {
        $this->amqpConnection->disconnect();
    }

}
