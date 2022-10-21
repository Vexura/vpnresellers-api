<?php


namespace VPNResellersAPI\Servers;

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
     */
    public function getServers()
    {
        return $this->VPNResellersAPI->get('servers');
    }

}