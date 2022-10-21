<?php


namespace VPNResellersAPI\Accounting;

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
     */
    public function checkUsername(string $username)
    {
        return $this->VPNResellersAPI->get('accounts/check_username?username=' . $username);
    }

    /**
     * @return array|string
     */
    public function listAccounts()
    {
        return $this->VPNResellersAPI->get('accounts');
    }

    /**
     * @return array|string
     */
    public function createAccount(string $username, string $password)
    {
        return $this->VPNResellersAPI->post('accounts', [
            "username" => $username,
            "password" => $password
        ]);
    }

    /**
     * @return array|string
     */
    public function getAccount(int $id)
    {
        return $this->VPNResellersAPI->get('accounts/' . $id);
    }

    /**
     * @return array|string
     */
    public function deleteAccount(int $id)
    {
        return $this->VPNResellersAPI->delete('accounts/' . $id);
    }

    /**
     * @return array|string
     */
    public function enableAccount(int $id)
    {
        return $this->VPNResellersAPI->put('accounts/' . $id . '/enable');
    }

    /**
     * @return array|string
     */
    public function disableAccount(int $id)
    {
        return $this->VPNResellersAPI->put('accounts/' . $id . '/disable');
    }

    /**
     * @return array|string
     */
    public function changeAccountPassword(int $id, string $password)
    {
        return $this->VPNResellersAPI->put('accounts/' . $id . '/change_password', [
            "password" => $password
        ]);
    }

}