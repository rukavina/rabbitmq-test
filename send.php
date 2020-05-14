<?php

require_once __DIR__ . '/vendor/autoload.php';
$config = require_once('./config.php');

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection(...$config['rabbitmq']);
$channel = $connection->channel();

$channel->queue_declare($config['queue_name'], false, true, false, false);

$messageTxt = isset($argv[1])? $argv[1] : $config['message'];

$msg = new AMQPMessage($messageTxt);
$channel->basic_publish($msg, '', $config['queue_name']);

echo " [x] Sent '$messageTxt'\n";

$channel->close();
$connection->close();