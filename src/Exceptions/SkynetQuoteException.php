<?php


namespace Claassenmarius\LaravelSkynet\Exceptions;

use Exception;

class SkynetQuoteException extends Exception
{
    public function report()
    {
        ray('A quote exception occured');
    }

    public function render($request)
    {
        return response()->json([
            'error' => 'A skynet quote exception occured'
        ]);
    }
}
