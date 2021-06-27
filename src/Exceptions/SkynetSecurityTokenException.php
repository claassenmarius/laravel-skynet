<?php


namespace Claassenmarius\LaravelSkynet\Exceptions;


use Exception;

class SkynetSecurityTokenException extends Exception
{
    public function report()
    {
        ray('A security token exception occured');
    }

    public function render($request)
    {
        return response()->json([
            'error' => 'A skynet security token exception occured'
        ]);
    }
}
