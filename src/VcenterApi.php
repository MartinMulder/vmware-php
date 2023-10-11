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
use enguerr\VMWare\Endpoints\Vcenter\VM;
use enguerr\VMWare\Endpoints\Vcenter\Network;
use enguerr\VMWare\Endpoints\Vcenter\Datacenter;
use enguerr\VMWare\Endpoints\Vcenter\Cluster;
use enguerr\VMWare\Endpoints\Vcenter\Datastore;
use enguerr\VMWare\Endpoints\Vcenter\Deployment;
use enguerr\VMWare\Endpoints\Vcenter\Folder;
use enguerr\VMWare\Endpoints\Vcenter\Guest;
use enguerr\VMWare\Endpoints\Vcenter\Host;
use enguerr\VMWare\Endpoints\Vcenter\Tag;
use enguerr\VMWare\Endpoints\Vcenter\Resourcepool;

class VcenterApi extends Api
{
    use VM, Network, Datacenter, Cluster, Datastore, Deployment, Folder, Guest, Host, Resourcepool,Tag;

    const CONNECT_MODULE = 'vcenter';

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
