<?php


namespace Claassenmarius\LaravelSkynet\Exceptions;


use Exception;

class SkynetDeliveryEtaException extends Exception
{
    public function report()
    {
        ray('A delivery-eta exception occured');
    }

    public function render($request)
    {
        return response()->json([
            'error' => 'A delivery-eta exception occured'
        ]);
    }
}
