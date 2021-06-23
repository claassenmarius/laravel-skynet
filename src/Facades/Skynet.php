<?php


namespace Claassenmarius\LaravelSkynet\Facades;


use Illuminate\Support\Facades\Facade;

class Skynet extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'skynet';
    }
}
