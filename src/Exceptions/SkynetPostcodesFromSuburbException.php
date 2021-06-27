<?php


namespace Claassenmarius\LaravelSkynet\Exceptions;


use Exception;

class SkynetPostcodesFromSuburbException extends Exception
{
    public function report()
    {
        ray('A postcodes-from-suburb exception occured');
    }

    public function render($request)
    {
        return response()->json([
            'error' => 'A postcodes-from-suburb exception occured'
        ]);
    }
}
