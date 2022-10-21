<?php


namespace VPNResellersAPI\GeoLocation;

use GuzzleHttp\Exception\GuzzleException;
use VPNResellersAPI\VPNResellersAPI;

class GeoLocation
{
    private $VPNResellersAPI;

    public function __construct(VPNResellersAPI $VPNResellersAPI)
    {
        $this->VPNResellersAPI = $VPNResellersAPI;
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getGeoInfo()
    {
        return $this->VPNResellersAPI->get('geoip');
    }

}