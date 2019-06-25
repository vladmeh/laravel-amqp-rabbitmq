<?php

namespace App\Http\Controllers;

use App\Facades\Rabbit;
use App\Services\RabbitRpc;
use Bschmitt\Amqp\Publisher;
use ErrorException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitController extends Controller
{

    public $message = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<REQUEST type="get_webstore_pricelist">
    <OPTIONS get_as_attr="yes"/>
</REQUEST>
XML;

    public $queue = 'request_server_test';


    /**
     * @param RabbitRpc $rabbit
     * @return ResponseFactory|Response
     */
    public function rabbit()
    {
        $response = Rabbit::rpc($this->message, $this->queue);
        return response($response)->withHeaders([
            'Content-Type' => 'text/xml'
        ]);
    }

    /**
     * @return ResponseFactory|Response
     * @throws BindingResolutionException
     * @throws ErrorException
     */
    public function amqp()
    {
        /**@var Publisher $publisher */
        $publisher = app()->make(Publisher::class);

        $publisher->connect();
        $publisher->getConnection()->set_close_on_destruct();

        list($callback_queue, ,) = $publisher->getChannel()->queue_declare(
            '',
            false,
            false,
            true,
            false
        );

        $response = null;
        $corr_id = uniqid();
        $publisher->getChannel()->basic_consume(
            $callback_queue,
            '',
            false,
            true,
            false,
            false,
            function (AMQPMessage $message) use (&$response, $corr_id) {
                if ($message->get('correlation_id') === $corr_id) {
                    $response = $message->body;
                }
            }
        );

        $publisher->getChannel()->basic_publish(
            new AMQPMessage(
                $this->message,
                [
                    'correlation_id' => $corr_id,
                    'reply_to' => $callback_queue,
                ]
            ),
            '',
            $this->queue
        );

//    while (!$response){
        $publisher->getChannel()->wait(null, false, 20000);
//    }

        /**@var AMQPMessage $response */
        return response($response)->withHeaders([
            'Content-Type' => 'text/xml'
        ]);
    }
}
