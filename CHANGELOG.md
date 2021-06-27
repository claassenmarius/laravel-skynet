# Changelog

All notable changes to `laravel-skynet` will be documented in this file.

## 1.1.1 - 2021-06-27

### Fixed

- Fixed quote api endpoint
- Add default value to insurance type on quote method

## 1.1.0 - 2021-06-27

### Added

- Add exceptions and exception handling to every method provided by `Claassenmarius\LaravelSkynet\Skynet`
    - `securityToken` throws `SkynetSecurityTokenException`
    - `validateSuburbAndPostalCode` throws `SkynetValidateSuburbPostcodeException`
    - `postalCodesFromSuburb` throws `SkynetPostcodesFromSuburbException`
    - `quote` throws `SkynetQuoteException`
    - `deliveryETA` throws `SkynetDeliveryEtaException`
    - `createWaybill` throws `SkynetCreateWaybillException`
    - `waybillPOD` throws `SkynetGetWaybillPodException`
    - `trackWaybill` throws `SkynetTrackWaybillException`


## 1.0.0 - 2021-06-25

- initial release
