<?php


namespace App\Services;


use Illuminate\Support\Arr;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitConnection
{
    private $connect_options;

    /**
     * @var AMQPStreamConnection
     */
    private $connection;

    /**
     * @var AMQPChannel
     */
    private $channel;

    /**
     * Rabbit constructor.
     * @param $connect_options
     */
    public function __construct($connect_options)
    {
        $this->connect_options = $connect_options;

        $this->connection = new AMQPStreamConnection(
            Arr::get($connect_options, 'host'),
            Arr::get($connect_options, 'port'),
            Arr::get($connect_options, 'user'),
            Arr::get($connect_options, 'password'),

            Arr::get($connect_options, 'vhost'),
            Arr::get($connect_options, 'insist'),
            Arr::get($connect_options, 'login_method'),
            Arr::get($connect_options, 'login_response'),
            Arr::get($connect_options, 'locale'),
            Arr::get($connect_options, 'connection_timeout'),
            Arr::get($connect_options, 'read_write_timeout'),
            Arr::get($connect_options, 'context'),
            Arr::get($connect_options, 'keepalive'),
            Arr::get($connect_options, 'heartbeat'),
            Arr::get($connect_options, 'channel_rpc_timeout'),
            Arr::get($connect_options, 'ssl_protocol')
        );

        $this->channel = $this->connection->channel();
    }

    /**
     * @return AMQPStreamConnection
     */
    public function getConnection(): AMQPStreamConnection
    {
        return $this->connection;
    }

    /**
     * @return AMQPChannel
     */
    public function getChannel(): AMQPChannel
    {
        return $this->channel;
    }

    /**
     * @return array
     */
    public function getConnectOptions()
    {
        return $this->connect_options;
    }
}