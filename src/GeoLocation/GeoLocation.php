<?php


namespace VPNResellersAPI\GeoLocation;

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
     */
    public function getGeoInfo()
    {
        return $this->VPNResellersAPI->get('geoip');
    }

}