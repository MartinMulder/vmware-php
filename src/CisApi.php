<?php

namespace enguerr\VMWare;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Exception\ConnectException;
use enguerr\VMWare\Api;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;


// Add the API traits
use enguerr\VMWare\Endpoints\Cis\Tag;
use enguerr\VMWare\Endpoints\Cis\Category;

class CisApi extends Api
{
    use Tag,Category;

    const CONNECT_MODULE = 'cis';

    /**
     * Create an instance for the Vcenter API.
     * @param string $endpoint Your API endpoint, that should end on "/api/".
     * @param integer $retries Number of retries for failed requests.
     * @param array $guzzleOptions Optional options to be passed to the Guzzle Client constructor.
     */
    public function __construct($endpoint = 'https://vcenter.local/api/', $retries = 5, $guzzleOptions = [])
    {
        parent::__construct($endpoint, self::CONNECT_MODULE, $retries, $guzzleOptions);
    }


}
