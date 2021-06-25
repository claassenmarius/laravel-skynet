# Laravel Skynet

[![Tests](https://github.com/claassenmarius/php-skynet/actions/workflows/run-tests.yml/badge.svg)](https://github.com/claassenmarius/php-skynet/actions/workflows/run-tests.yml)
[![Check & fix styling](https://github.com/claassenmarius/php-skynet/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/claassenmarius/php-skynet/actions/workflows/php-cs-fixer.yml)



A Laravel package to use the Skynet Courier API.

## Installation

Require the package using composer:
```bash
composer require claassenmarius/laravel-skynet
```

## Usage

Add the following environment variables to your `.env` file and add your Skynet account username, password, system id and account number.

```
SKYNET_ACCOUNT_USERNAME=
SKYNET_ACCOUNT_PASSWORD=
SKYNET_SYSTEM_ID=
SKYNET_ACCOUNT_NUMBER=
```
You can obtain an instance of `Claassenmarius\LaravelSkynet\Skynet` in any of the following ways:

### Type-hinting / Dependency injection
When type-hinting `Skynet` in a method, Laravel will automatically resolve it from the IOC container for you.

```php
use Claassenmarius\LaravelSkynet\Skynet;

class QuoteController extends Controller
{
    public function __invoke(Skynet $skynet)
    {
        $response = $skynet->quote(...);
        
        // do somethin with the $response
    }    
}
```
### Facade 
You can use the `Skynet` Facade.
```php
use Claassenmarius\LaravelSkynet\Facades\Skynet;

class QuoteController extends Controller
{
    public function __invoke()
    {
        $response = Skynet::quote(...);
        
        // do somethin with the $response
    }   
}
```
### Manually resolving it from the IOC container
```php
use Claassenmarius\LaravelSkynet\Skynet;

class QuoteController extends Controller
{
    public function __invoke()
    {
        $skynet = app()->make(Skynet::class);
        
        $response = $skynet->quote(...);
        
        // do somethin with the $response
    }   
}
```

### Manual instantiation
If you plan on instantiating `Skynet` manually throughout your project it won't be neccessary to add your Skynet credentials to the `.env` file. Instead, pass
your credentials to the constructor.
```php
use Claassenmarius\LaravelSkynet\Skynet;

class QuoteController extends Controller
{
    public function __invoke()
    {
        $skynet = new Skynet(
          'skynet_username',
          'skynet_password',
          'skynet_system_id',
          'skynet_account_number'
        );
        
        $response = $skynet->quote(...);
        
        // do somethin with the $response
    }
}
```


The following methods are available to [get a security token](#get-a-security-token), [validate a suburb/postcode combination](#validate-a-suburb-and-postal-code-combination), [get a list of postal
codes for a suburb](#get-a-list-of-postal-codes-for-a-suburb), [get a quote for a parcel](#get-a-quote-for-a-parcel), [get an ETA between two locations](#get-eta-between-two-locations), [generate a waybill](#generate-a-waybill), [obtain a POD image](#get-a-waybill-pod-image) and
[track a waybill](#track-a-waybill). Each method returns a new `Illuminate\Http\Client\Response` which 
[exposes methods](#response) to inspect the response.

### Get a security token

```php
$response = $skynet->securityToken();
```

### Validate a suburb and postal code combination
```php
$response = $skynet->validateSuburbAndPostalCode([
    'suburb' => 'Brackenfell',
    'postal-code' => '7560'
]);
```

### Get a list of postal codes for a suburb
```php
$response = $skynet->postalCodesFromSuburb('Brackenfell');
```

### Get a quote for a parcel
```php
$response = $skynet->quote([
    'collect-city' => 'Brackenfell',
    'deliver-city' => 'Stellenbosch',
    'deliver-postcode' => '7600',
    'service-type' => 'ON1',
    'insurance-type' => '1',
    'parcel-insurance' => '0',    
    'parcel-length' => 10, //cm
    'parcel-width' => 20, // cm
    'parcel-height' => 30, //cm
    'parcel-weight' => 20 //kg
]);
```

### Get ETA between two locations
```php
$response = $skynet->deliveryETA([
    'from-suburb' => 'Brackenfell',
    'from-postcode' => '7560',
    'to-suburb' => 'Stellenbosch',
    'to-postcode' => '7600',
    'service-type' => 'ON1'
]);
```

### Generate a waybill
```php
$response = $skynet->createWaybill([
    "customer-reference" => "Customer Reference",
    "GenerateWaybillNumber" => true,
    "service-type" => "ON1",
    "collection-date" => "2021-06-26",
    "from-address-1" => "3 Janie Street, Ferndale, Brackenfell",
    "from-suburb" => "Brackenfell",
    "from-postcode" => "7560",
    "to-address-1" => "15 Verreweide Street, Universiteitsoord, Stellenbosch",
    "to-suburb" => "Stellenbosch",
    "to-postcode" => "7600",
    "insurance-type" => "1",
    "insurance-amount" => "0",
    "security" => "N",
    "parcel-number" => "1",
    "parcel-length" => 10,
    "parcel-width" => 20,
    "parcel-height" => 30,
    "parcel-weight" => 10,
    "parcel-reference" => "12345",
    "offsite-collection" => true
]);
```

### Get a waybill POD Image
```php
$response = $skynet->waybillPOD('your-waybill-number');
```

### Track a waybill
```php
$response = $skynet->trackWaybill('your-waybill-number');
```

## Response
`Illuminate\Http\Client\Response` provides the following methods to inspect the response.

### Get the body of the response as a string:
```php
$securityToken = $response->body(); 
// "{"SecurityToken":"2_f77e4922-1407-485e-a0fa-4fdd5c29e9ca"}" 
```

### Get the JSON decoded body of the response as an array or scalar value (if a $key is passed in)
```php
$securityToken = $response->json($key); 
// ["SecurityToken" => "2_c767aa41-bca8-4084-82a0-69d8e27fba2c"] 
```

### Get the JSON decoded body of the response as an object.
```php
$securityToken = $response->object(); 
// { +"SecurityToken": "2_c767aa41-bca8-4084-82a0-69d8e27fba2c" }
```

### Get the JSON decoded body of the response as a collection.
```php
$securityToken = $response->collect($key); 
```

### Get a header from the response.
```php
$header = $response->header($header); 
// "application/json; charset=utf-8"
```

### Get the headers from the response.
```php
$headers = $response->headers(); 
// Return an array of all headers
```
### Get the status code of the response.
```php
$headers = $response->status(); 
// 200
```

### Determine if the request was successful (Whether status code `>=200` & `<300`)
```php
$headers = $response->successful(); 
// true
```

### Determine if the response code was "OK". (Status code === `200`)
```php
$headers = $response->ok(); 
// true
```

### Determine if server error occurred. (Whether status code `>=500`)
```php
$headers = $response->serverError(); 
// false
```

### Determine if client or server error occurred.
```php
$headers = $response->failed(); 
// false
```

You can inspect the Laravel documentation for more information on the methods that `Illuminate\Http\Client\Response` provide.

## Exception Handling
This package uses Laravel's Http Client behind the scenes, which does not throw exceptions on client or server errors (400 and 500 level responses from servers). 
You may determine if one of these errors was returned using the successful, clientError, or serverError methods.

If you have a response instance and would like to throw an instance of `Illuminate\Http\Client\RequestException` if the response status code indicates a client or 
server error, you may use the throw method:

```php
response = $skynet->quote(...);

if($response->failed()) {
// Throw an exception if a client or server error occurred...
  $response->throw();
}
```

## Testing
```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email marius.claassen@outlook.com instead of using the issue tracker.

## License
The MIT Licence (MIT). Please see [Licence File](LICENCE.md) for more information.

