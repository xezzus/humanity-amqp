<?php
namespace humanity\amqp;

class Connection
{
    public $host;
    public $login;
    public $password;
    public $port;
    public $vhost = '/';
    private $amqpChannel;

    public function __construct($host,$port,$login,$password,$vhost='/'){
        $this->amqpConnection = new \AMQPConnection();
        $this->amqpConnection->setHost($host);
        $this->amqpConnection->setLogin($login);
        $this->amqpConnection->setPassword($password);
        $this->amqpConnection->setVhost($vhost);
        $this->amqpConnection->connect();
        $this->amqpChannel = New \AMQPChannel($this->amqpConnection);
    }

    public function exchange($name)
    {
        return new Message($this->amqpConnection, $this->amqpChannel, $name);
    }

    public function disconnect()
    {
        $this->amqpConnection->disconnect();
    }

}
