<?php


namespace Claassenmarius\LaravelSkynet\Exceptions;

use Exception;

class SkynetGetWaybillPodException extends Exception
{
    public function report()
    {
        ray('A get-waybill-pod exception occured');
    }

    public function render($request)
    {
        return response()->json([
            'error' => 'A get-waybill-pod exception occured'
        ]);
    }
}
