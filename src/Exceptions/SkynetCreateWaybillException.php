<?php


namespace Claassenmarius\LaravelSkynet\Exceptions;


use Exception;

class SkynetCreateWaybillException extends Exception
{
    public function report()
    {
        ray('A create-waybill exception occured');
    }

    public function render($request)
    {
        return response()->json([
            'error' => 'A create-waybill exception occured'
        ]);
    }
}
