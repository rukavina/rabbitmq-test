<?php

return [
    'queue_name' => 'hello',
    'message' => 'Hello world',
    'rabbitmq' => [
        'localhost', //$host,
        5672, //$port,
        'guest', //$user,
        'guest', //$password,
        '/', //$vhost = '/',
        false, //$insist = false,
        'AMQPLAIN', //$login_method = 'AMQPLAIN',
        null, //$login_response = null,
        'en_US', //$locale = 'en_US',
        3, //$connection_timeout = 3,
        3, //$read_write_timeout = 3,
        null, //$context = null,
        false, //$keepalive = false,
        0, //$heartbeat = 0        
    ],
];