<?php
namespace amqpim;

use yii\base\component;

class Message extends Component
{

    private $amqpConnection;
    private $amqpChannel;
    private $name;

    public function __construct($amqpConnection, $amqpChannel, $name)
    {
        $this->amqpConnection = $amqpConnection;
        $this->amqpChannel = $amqpChannel;
        $this->name = $name;
    }

    public function send($msg)
    {
        $ex = new \AMQPExchange($this->amqpChannel);
        $ex->setName($this->name);
        $ex->publish($msg);
        return $this;
    }

    public function take()
    {
        $q = new \AMQPQueue($this->amqpChannel);
        $q->setName($this->name);
        $msg = $q->get();
        if (empty($msg)) {
            return false;
        } else {
            return new MessageTakeControl($q, $msg);
        }
    }
}
