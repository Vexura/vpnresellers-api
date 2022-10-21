<?php


namespace VPNResellersAPI\Accounts;

use GuzzleHttp\Exception\GuzzleException;
use VPNResellersAPI\VPNResellersAPI;

class Accounts
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
    public function checkUsername(string $username)
    {
        return $this->VPNResellersAPI->get('accounts/check_username?username=' . $username);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function listAccounts()
    {
        return $this->VPNResellersAPI->get('accounts');
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function createAccount(string $username, string $password)
    {
        return $this->VPNResellersAPI->post('accounts', ['json' => [
            "username" => $username,
            "password" => $password
        ]
        ]);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function getAccount(int $id)
    {
        return $this->VPNResellersAPI->get('accounts/' . $id);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function deleteAccount(int $id)
    {
        return $this->VPNResellersAPI->delete('accounts/' . $id);
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function enableAccount(int $id)
    {
        return $this->VPNResellersAPI->put('accounts/' . $id . '/enable');
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function disableAccount(int $id)
    {
        return $this->VPNResellersAPI->put('accounts/' . $id . '/disable');
    }

    /**
     * @return array|string
     * @throws GuzzleException
     */
    public function changeAccountPassword(int $id, string $password)
    {
        return $this->VPNResellersAPI->put('accounts/' . $id . '/change_password', ['json' => [
            "password" => $password
        ]]);
    }

}