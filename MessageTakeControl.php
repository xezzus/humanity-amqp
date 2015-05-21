<?php
namespace amqpim;

class MessageTakeControl
{

    private $queue;
    private $message;

    public function __construct($queue, $message)
    {
        $this->queue = $queue;
        $this->message = $message;
    }

    public function msg()
    {
        return $this->message->getBody();
    }

    public function ack()
    {
        $this->queue->ack($this->message->getDeliveryTag());
    }
}
