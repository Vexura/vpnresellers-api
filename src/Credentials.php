<?php


namespace VPNResellersAPI;

class Credentials
{
    private $token;
    private $url;

    /**
     * Credentials constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
        $this->url = 'https://api.vpnresellers.com/docs/v3_2/'; // This is the base URL for the API
    }

    public function __toString()
    {
        return sprintf(
            '[Host: %s], [Token: %s].',
            $this->url,
            $this->token
        );
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

}
