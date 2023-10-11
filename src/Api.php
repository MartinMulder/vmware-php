<?php

namespace enguerr\VMWare;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ConnectException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Sabre\DAV\Exception;


abstract class Api
{
    /** @var string */
    protected $endpoint;

    /** @var array */
    protected $auth;

    /** @var Client */
    protected $client;

    /** @var integer */
    protected $retries;

    /** @var array */
    protected $custom_headers=array('content-type' => 'application/json');

    protected $module = '';

    /**
     * Create an instance for the VMWare API.
     * @param string $endpoint Your API endpoint, that should end on "/rest/".
     * @param integer $retries Number of retries for failed requests.
     * @param array $guzzleOptions Optional options to be passed to the Guzzle Client constructor.
     */
    public function __construct($endpoint = 'https://vcenter.local/api/', $module,  $retries = 5, $guzzleOptions = [])
    {
        $this->endpoint = $endpoint;
        $this->retries = $retries;
        $this->module = $module;

        $this->client = new Client(array_merge([
            'base_uri' => $this->endpoint,
            'verify' => false,
            'cookies' => true,
        ], $guzzleOptions));

        /** @var HandlerStack $handler */
        $handler = $this->client->getConfig('handler');
        $handler->unshift($this->cookieMiddleware());
        $handler->unshift($this->retryMiddleware());
        $handler->unshift($this->tokenMiddleware());

    }


    /**
     * Login regularly using username/password combination.
     * @param $username
     * @param $password
     * @param callable $tokenCallback Pass a callback function that receives a `$token` as its only parameter, which you
     * then need to persist in your own logic, so subsequent calls can use that token. The function needs to return your
     * `token` as well.
     * @param string $type The type you wish to login as. Either 'operator' (default)  or 'person'.
     * @return $this
     */
    public function login($username, $password)
    {
        $this->auth = [
            'url' => 'session',
            'authenticated' => false,
            'username' => $username,
            'password' => $password
        ];
        $auth = $this->auth;
        //get token
        $response = $this->client->request('POST', $auth['url'], [
            'auth' => [$auth['username'], $auth['password']],
            /*'debug' =>  true*/
        ]);
        $this->custom_headers['vmware-api-session-id'] = json_decode((string)$response->getBody()->getContents());
        $auth['authenticated'] = true;
        $this->auth = $auth;

        return $this;
    }

    /**
     * *Logout regularly using username/password combination.
     * @return $this
     */
    public function logout()
    {
        if (isset($this->custom_headers['vmware-api-session-id']))
            $token = $this->custom_headers['vmware-api-session-id'];
        else throw new Exception('Can\'t logout: not connected');
        $options = array(
            'headers'=> $this->custom_headers,
        );
        //get token
        $this->client->request('DELETE', $this->auth['url'],$options);
        $this->auth['authenticated'] = false;
        return $this;
    }
    /**
     * Middleware: Adds correct authorization headers.
     * @return callable
     */
    private function tokenMiddleware()
    {
        return Middleware::mapRequest(function (RequestInterface $request) {
            $auth = $this->auth;
            if (!$auth) {
                throw new VMWareException('You need to call "login" first.');
            }
            $authenticated = $auth['authenticated'];
            if (strpos($request->getUri()->getPath(), 'session') === false) {
                if ($authenticated === false) {
                    throw new VMWareException('You need to call "login" first.');
                }
                return $request;
            }
            return $request;
        });
    }

    /**
     * Middleware: Retry API request on failed connections or server exceptions, up to a max of RETRIES.
     * @return callable
     */
    private function retryMiddleware()
    {
        return Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response = null, RequestException $exception = null) {
            // Limit the number of retries.
            if ($retries >= $this->retries) {
                return false;
            }

            // Retry connection exceptions.
            if ($exception instanceof ConnectException || $exception instanceof ServerException) {
                return true;
            }

            return false;
        });
    }

    /**
     * Middleware: Add a cookiejar to the connection to limit authentication requests
     * @return callable
     */
    private function cookieMiddleware()
    {
        return Middleware::cookies();
    }

    /**
     * Shorthand function to create requests with JSON body and query parameters.
     * @param $method
     * @param string $uri
     * @param array $json
     * @param array $query
     * @param array $options
     * @param boolean $decode JSON decode response body (defaults to true).
     * @return mixed|ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function request($method, $uri = '', array $json = [], array $query = [], array $headers = [], $decode = true)
    {
        $options = array(
            'headers'=> array_merge($this->custom_headers, $headers),
            'query' => $query,
            /*'debug' => true*/
        );
        if ($method=="POST"||$method=="PATCH"){
            $options['json'] = $json;
        }
        $response = $this->client->request($method, $this->module . "/" . $uri, $options);
        return $decode ? json_decode((string)$response->getBody(), true) : (string)$response->getBody();
    }
}
