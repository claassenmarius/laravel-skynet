<?php


namespace Claassenmarius\LaravelSkynet\Exceptions;


use Exception;

class SkynetTrackWaybillException extends Exception
{
    public function report()
    {
        ray('A track-waybill exception occured');
    }

    public function render($request)
    {
        return response()->json([
            'error' => 'A track-waybill exception occured'
        ]);
    }
}
