<?php


namespace Claassenmarius\LaravelSkynet\Exceptions;


use Exception;

class SkynetValidateSuburbPostcodeException extends Exception
{
    public function report()
    {
        ray('A validate-suburb-postcode exception occured');
    }

    public function render($request)
    {
        return response()->json([
            'error' => 'A validate-suburb-postcode exception occured'
        ]);
    }
}
