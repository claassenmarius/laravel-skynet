<?php


namespace Claassenmarius\LaravelSkynet;

use Illuminate\Support\Facades\Http;

class Skynet
{
    private string $username;
    private string $password;
    private string $systemId;
    private string $accountNumber;

    public function __construct(
        string $username,
        string $password,
        string $systemId,
        string $accountNumber
    ) {
        $this->username = $username;
        $this->password = $password;
        $this->systemId = $systemId;
        $this->accountNumber = $accountNumber;
    }

    private function securityToken(): string
    {
        return Http::post('https://api.skynet.co.za:3227/api/Security/GetSecurityToken', [
            'Username' => $this->username,
            'Password' => $this->password,
            'SystemId' => $this->systemId,
            'AccountNumber' => $this->accountNumber,
        ])->json('SecurityToken');
    }

    public function validateSuburbAndPostalCode(array $location)
    {
        return Http::post('https://api.skynet.co.za:3227/api/Validation/ValidateSuburbPostalCode', [
            'suburb' => $location['suburb'],
            'postalCode' => $location['postal-code'],
        ]);
    }

    public function postalCodesFromSuburb(string $suburb)
    {
        return Http::post('https://api.skynet.co.za:3227/api/Validation/GetPostalCode/', [
            'securityToken' => $this->getSecurityToken(),
            'suburbName' => $suburb,
        ]);
    }

    public function quote(array $parcelData)
    {
        return Http::post('https://api.skynet.co.za:3227/api/Financial/GetQuote', [
            'SecurityToken' => $this->getSecurityToken(),
            'AccountNumber' => $this->accountNumber,
            'FromCity' => $parcelData['collect-city'],
            'ToCity' => $parcelData['deliver-city'],
            'ServiceType' => $parcelData['service-type'],
            'InsuranceType' => $parcelData['insurance-type'],
            'InsuranceAmount' => $parcelData['parcel-insurance'],
            'DestinationPCode' => $parcelData['deliver-postcode'],
            'ParcelList' => [[
                'parcel_number' => "1",
                'parcel_length' => $parcelData['parcel-length'],
                'parcel_breadth' => $parcelData['parcel-width'],
                'parcel_height' => $parcelData['parcel-height'],
                'parcel_mass' => $parcelData['parcel-weight'],
            ]],
        ]);
    }

    public function deliveryETA(array $locations)
    {
        return Http::post('https://api.skynet.co.za:3227/api/Waybill/GetWaybillETA', [
            'SecurityToken' => $this->getSecurityToken(),
            'AccountNumber' => $this->accountNumber,
            'FromSuburb' => $locations['from-suburb'],
            'FromPostCode' => $locations['from-postcode'],
            'ToSuburb' => $locations['to-suburb'],
            'ToPostCode' => $locations['to-postcode'],
            'ServiceType' => $locations['service-type'],
        ]);
    }

    public function createWaybill(array $waybillData)
    {
        return Http::post('https://api.skynet.co.za:3227/api/waybill/CreateWaybill', [
            "SecurityToken" => $this->getSecurityToken(),
            "AccountNumber" => $this->accountNumber,
            "CompanyName" => $waybillData['company-name'] ?? null,
            "CustomerReference" => $waybillData['customer-reference'],
            "WaybillNumber" => $waybillData['waybill-number'] ?? null,
            "GenerateWaybillNumber" => $waybillData['generate-waybill-number'] ?? false,
            "ServiceType" => $waybillData['service-type'],
            "CollectionDate" => $waybillData['collection-date'] ?? null,
            "DeliveryDate" => $waybillData['delivery-date'] ?? null,
            "Instructions" => $waybillData['instructions'] ?? null,
            "FromAddressName" => $waybillData['from-address-name'] ?? null,
            "FromAddress1" => $waybillData['from-address-1'],
            "FromAddress2" => $waybillData['from-address-2'] ?? null,
            "FromAddress3" => $waybillData['from-address-3'] ?? null,
            "FromAddress4" => $waybillData['from-address-4'] ?? null,
            "FromSuburb" => $waybillData['from-suburb'],
            "FromCity" => $waybillData['from-city'] ?? null,
            "FromPostCode" => $waybillData['from-postcode'],
            "FromAddressLatitude" => $waybillData['from-address-latitude'] ?? null,
            "FromAddressLongitude" => $waybillData['from-address-longitude'] ?? null,
            "FromTelephone" => $waybillData['from-telephone'] ?? null,
            "FromFax" => $waybillData['from-fax'] ?? null,
            "FromOfficeTelephonenumber" => $waybillData['from-office-telephone-number'] ?? null,
            "FromAlternativeContactName" => $waybillData['from-alternative-contact-name'] ?? null,
            "FromAlternativeContactNumber" => $waybillData['from-alternative-contact-number'] ?? null,
            "FromBuildingComplex" => $waybillData['from-building-complex'] ?? null,
            "ToAddressName" => $waybillData['to-address-name'] ?? null,
            "ToAddress1" => $waybillData['to-address-1'],
            "ToAddress2" => $waybillData['to-address-2'] ?? null,
            "ToAddress3" => $waybillData['to-address-3'] ?? null,
            "ToAddress4" => $waybillData['to-address-4'] ?? null,
            "ToSuburb" => $waybillData['to-suburb'],
            "ToCity" => $waybillData['to-city'] ?? null,
            "ToPostCode" => $waybillData['to-postcode'],
            "ToAddressLatitude" => $waybillData['to-address-latitude'] ?? null,
            "ToAddressLongitude" => $waybillData['to-address-longitude'] ?? null,
            "ToTelephone" => $waybillData['to-telephone'] ?? null,
            "ToFax" => $waybillData['to-fax'] ?? null,
            "ToOfficeTelephonenumber" => $waybillData['to-office-telephone-number'] ?? null,
            "ToAlternativeContactName" => $waybillData['to-alternative-contact-name'] ?? null,
            "ToAlternativeContactNumber" => $waybillData['to-alternative-contact-number'] ?? null,
            "ToBuildingComplex" => $waybillData['to-building-complex'] ?? null,
            "ReadyTime" => $waybillData['ready-time'] ?? null,
            "OpenTill" => $waybillData['open-till'] ?? null,
            "InsuranceType" => $waybillData['insurance-type'] ?? '1',
            "InsuranceAmount" => $waybillData['insurance-amount'] ?? '0',
            "Security" => $waybillData['security'] ?? 'N',
            "ParcelList" => [
                "parcel_number" => "1",
                "parcel_length" => $waybillData['parcel-length'],
                "parcel_breadth" => $waybillData['parcel-width'],
                "parcel_height" => $waybillData['parcel-height'] ,
                "parcel_mass" => $waybillData['parcel-weight'],
                "parcel_description" => $waybillData['parcel-description'] ?? null,
                "parcel_reference" => $waybillData['parcel-reference'],
            ],
            "OffSiteCollection" => $waybillData['offsite-collection'] ?? false,
        ]);
    }

    public function waybillPOD(string $waybillNumber)
    {
        return Http::post('https://api.skynet.co.za:3227/api/Waybill/GetWaybillPOD', [
            'SecurityToken' => $this->getSecurityToken(),
            'WaybillNumber' => $waybillNumber,
        ]);
    }

    public function trackWaybill(string $waybillNumber)
    {
        return Http::post('https://api.skynet.co.za:3227/api/waybill/GetWaybillTracking', [
            'WaybillReference' => $waybillNumber,
        ]);
    }
}
