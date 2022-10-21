<?php


namespace VPNResellersAPI\Servers;

use GuzzleHttp\Exception\GuzzleException;
use VPNResellersAPI\VPNResellersAPI;

class Servers
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
    public function getServers()
    {
        return $this->VPNResellersAPI->get('servers');
    }

}