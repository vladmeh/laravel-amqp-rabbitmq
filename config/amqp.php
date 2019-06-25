<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Define which configuration should be used
    |--------------------------------------------------------------------------
    */

    'use' => 'production',

    /*
    |--------------------------------------------------------------------------
    | AMQP properties separated by key
    |--------------------------------------------------------------------------
    */

    'properties' => [

        'production' => [
            'host'                  => env('RABBITMQ_HOST','localhost'),
            'port'                  => env('RABBITMQ_PORT', 5672),
            'username'              => env('RABBITMQ_USER', 'guest'),
            'password'              => env('RABBITMQ_PASSWORD', 'guest'),
            'vhost'                 => env('RABBITMQ_VHOST', '/'),
            'connect_options'       => [],
            'ssl_options'           => [],

            'exchange'              => env('RABBITMQ_EXCHANGE','amq.topic'),
            'exchange_type'         => env('RABBITMQ_EXCHANGE_TYPE','topic'),
            'exchange_passive'      => env('RABBITMQ_EXCHANGE_PASSIVE',false),
            'exchange_durable'      => env('RABBITMQ_EXCHANGE_DURABLE',true),
            'exchange_auto_delete'  => env('RABBITMQ_EXCHANGE_AUTO_DELETE',false),
            'exchange_internal'     => env('RABBITMQ_EXCHANGE_INTERNAL',false),
            'exchange_nowait'       => env('RABBITMQ_EXCHANGE_NOWAIT',false),
            'exchange_properties'   => [],

            'queue_force_declare'   => env('RABBITMQ_QUEUE_FORCE_DECLARE', false),
            'queue_passive'         => env('RABBITMQ_QUEUE_PASSIVE',false),
            'queue_durable'         => env('RABBITMQ_QUEUE_DURABLE',true),
            'queue_exclusive'       => env('RABBITMQ_QUEUE_EXCLUSIVE',false),
            'queue_auto_delete'     => env('RABBITMQ_QUENE_AUTO_DELETE',false),
            'queue_nowait'          => env('RABBITMQ_QUEUE_NOWAIT',false),
            'queue_properties'      => ['x-ha-policy' => ['S', 'all']],

            'consumer_tag'          => env('RABBITMQ_CONSUMER_TAG',''),
            'consumer_no_local'     => env('RABBITMQ_CONSUMER_NO_LOCAL',false),
            'consumer_no_ack'       => env('RABBITMQ_CONSUMER_NO_ACK',false),
            'consumer_exclusive'    => env('RABBITMQ_CONSUMER_EXCLUSIVE',false),
            'consumer_nowait'       => env('RABBITMQ_CONSUMER_NOWAIT',false),
            'timeout'               => env('RABBITMQ_TIMEOUT',0),
            'persistent'            => env('RABBITMQ_PERSISTENT',false),

            'qos'                   => env('RABBITMQ_QOS',false),
            'qos_prefetch_size'     => env('RABBITMQ_QOS_PREFETCH_SIZE',0),
            'qos_prefetch_count'    => env('RABBITMQ_QOS_PREFETCH_COUNT',1),
            'qos_a_global'          => env('RABBITMQ_QOS_A_GLOBAL',false)
        ],

    ],

];
