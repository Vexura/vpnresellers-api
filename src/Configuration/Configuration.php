<?php


namespace VPNResellersAPI\Configuration;

use GuzzleHttp\Exception\GuzzleException;
use VPNResellersAPI\VPNResellersAPI;

class Configuration
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
    public function getPorts()
    {
        return $this->VPNResellersAPI->get('ports');
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getConfiguration(int $serverId, int $portId)
    {
        return $this->VPNResellersAPI->get('configuration?server_id='.$serverId.'&port_id=' . $portId);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getWireGuardConfiguration(int $account,int $serverId)
    {
        return $this->VPNResellersAPI->get('accounts/'.$account.'/wireguard-configuration?server_id='.$serverId);
    }
}