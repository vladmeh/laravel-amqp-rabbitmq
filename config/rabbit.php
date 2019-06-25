<?php

return [
    'connections' => [
        'stream' => [
            'host'                  => env('RABBITMQ_HOST','localhost'),
            'port'                  => env('RABBITMQ_PORT', 5672),
            'user'                  => env('RABBITMQ_USER', 'guest'),
            'password'              => env('RABBITMQ_PASSWORD', 'guest'),
            'vhost'                 => env('RABBITMQ_VHOST', '/'),
            'insist'                => false,
            'login_method'          => 'AMQPLAIN',
            'login_response'        => null,
            'locale'                => 'en_US',
            'connection_timeout'    => 3.0,
            'read_write_timeout'    => 130.0,
            'context'               => null,
            'keepalive'             => false,
            'heartbeat'             => 60,
            'channel_rpc_timeout'   => 0.0,
            'ssl_protocol'          => null
        ],
        'ssl' => [

        ]
    ]
];