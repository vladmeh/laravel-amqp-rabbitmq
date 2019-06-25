<?php


namespace App\Services;


use Illuminate\Contracts\Container\BindingResolutionException;

class Rabbit
{
    /**
     * @param string $message
     * @param string $queue
     * @return string
     * @throws BindingResolutionException
     */
    public function rpc($message, $queue){
        $rabbitRpc = app()->make(RabbitRpc::class);
        return $rabbitRpc->handle($message, $queue);
    }
}