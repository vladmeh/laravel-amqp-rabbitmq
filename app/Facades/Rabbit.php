<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static string rpc(string $message, string $queue)
 */
class Rabbit extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Rabbit';
    }
}