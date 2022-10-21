<?php


namespace VPNResellersAPI;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use VPNResellersAPI\Accounts\Accounts;
use VPNResellersAPI\Configuration\Configuration;
use VPNResellersAPI\Exception\ParameterException;
use VPNResellersAPI\GeoLocation\GeoLocation;
use VPNResellersAPI\Servers\Servers;

class VPNResellersAPI
{
    private $httpClient;
    private $credentials;
    private $apiToken;
    private $accountingHandler;
    private $serversHandler;
    private $geoLocationHandler;
    private $configurationHandler;

    /**
     * VPNResellersAPI constructor.
     *
     * @param string $token API Token for all requests
     * @param null $httpClient
     */
    public function __construct(string $token, $httpClient = null) {
        $this->apiToken = $token;
        $this->setHttpClient($httpClient);
        $this->setCredentials($token);
    }


    public function setHttpClient(Client $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new Client([
            'allow_redirects' => false,
            'follow_redirects' => false,
            'timeout' => 120,
            'http_errors' => false,
        ]);
    }

    public function setCredentials($credentials)
    {
        if (!$credentials instanceof Credentials) {
            $credentials = new Credentials($credentials);
        }

        $this->credentials = $credentials;
    }

    /**
     * @return Client
     */
    public function getHttpClient(): Client
    {
        return $this->httpClient;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->apiToken;
    }


    /**
     * @return Credentials
     */
    private function getCredentials(): Credentials
    {
        return $this->credentials;
    }


    /**
     * @param string $actionPath The resource path you want to request, see more at the documentation.
     * @param array $params Array filled with request params
     * @param string $method HTTP method used in the request
     *
     * @return ResponseInterface
     *
     * @throws ParameterException|GuzzleException If the given field in params is not an array
     */
    private function request(string $actionPath, array $params = [], string $method = 'GET'): ResponseInterface
    {
        $url = $this->getCredentials()->getUrl() . $actionPath;

        if (!is_array($params)) {
            throw new ParameterException();
        }

        //$params['Authorization'] = 'Bearer ' . $this->apiToken;

        switch ($method) {
            case 'GET':
                return $this->getHttpClient()->get($url, ['verify' => false, 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->apiToken, $params]]);
            case 'POST':
                return $this->getHttpClient()->post($url, ['verify' => false, 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->apiToken], $params]);
            case 'PUT':
                return $this->getHttpClient()->put($url, ['verify' => false, 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->apiToken], $params]);
            case 'DELETE':
                return $this->getHttpClient()->delete($url, ['verify' => false, 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->apiToken], $params]);
            case 'PATCH':
                return $this->getHttpClient()->patch($url, ['verify' => false, 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->apiToken], $params]);
            default:
                throw new ParameterException('Wrong HTTP method passed');
        }
    }

    private function processRequest(ResponseInterface $response)
    {
        $response = $response->getBody()->__toString();
        $result = json_decode($response);
        if (json_last_error() == JSON_ERROR_NONE) {
            return $result;
        } else {
            return $response;
        }
    }


    /**
     * @throws GuzzleException
     */
    public function get($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params);

        return $this->processRequest($response);
    }

    /**
     * @throws GuzzleException
     */
    public function post($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'POST');

        return $this->processRequest($response);
    }

    /**
     * @throws GuzzleException
     */
    public function put($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'PUT');

        return $this->processRequest($response);
    }

    /**
     * @throws GuzzleException
     */
    public function delete($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'DELETE');

        return $this->processRequest($response);
    }

    /**
     * @throws GuzzleException
     */
    public function patch($actionPath, $params = [])
    {
        $response = $this->request($actionPath, $params, 'PATCH');

        return $this->processRequest($response);
    }

    /**
     * @return Accounts
     */
    public function accounts(): Accounts
    {
        if (!$this->accountingHandler) $this->accountingHandler = new Accounts($this);
        return $this->accountingHandler;
    }

    /**
     * @return Configuration
     */
    public function configuration(): Configuration
    {
        if (!$this->configurationHandler) $this->configurationHandler = new Configuration($this);
        return $this->configurationHandler;
    }

    /**
     * @return GeoLocation
     */
    public function geoLocation(): GeoLocation
    {
        if (!$this->geoLocationHandler) $this->geoLocationHandler = new GeoLocation($this);
        return $this->geoLocationHandler;
    }

    /**
     * @return Servers
     */
    public function servers(): Servers
    {
        if (!$this->serversHandler) $this->serversHandler = new Servers($this);
        return $this->serversHandler;
    }


}
