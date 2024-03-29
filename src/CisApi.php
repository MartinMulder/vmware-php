<?php

namespace MartinMulder\VMWare;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ConnectException;
use MartinMulder\VMWare\Api;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


// Add the API traits
use MartinMulder\VMWare\Endpoints\Cis\Tag;

class CisApi extends Api
{
    use Tag;

    const CONNECT_MODULE = 'com/vmware/cis';

    /**
     * Create an instance for the Vcenter API.
     * @param string $endpoint Your API endpoint, that should end on "/rest/".
     * @param integer $retries Number of retries for failed requests.
     * @param array $guzzleOptions Optional options to be passed to the Guzzle Client constructor.
     */
    public function __construct($endpoint = 'https://vcenter.local/rest/', $retries = 5, $guzzleOptions = [])
    {
        parent::__construct($endpoint, self::CONNECT_MODULE, $retries, $guzzleOptions);
    }


}
