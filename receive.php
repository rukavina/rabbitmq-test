<?php

require_once __DIR__ . '/vendor/autoload.php';
$config = require_once('./config.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection(...$config['rabbitmq']);
$channel = $connection->channel();

$channel->queue_declare($config['queue_name'], false, true, false, false);

echo " [*] Waiting for messages on the queue [{$config['queue_name']}]. To exit press CTRL+C\n";

$channel->basic_qos(null, 1, null);

$channel->basic_consume($config['queue_name'], '', false, false, false, false, function($msg) use ($connection, $channel){
    echo ' [x] Received ', $msg->body, "\n";
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
});

while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();