<?php

namespace MartinMulder\VMWare\Endpoints\Appliance;

trait Networking
{
    /**
     * @see https://developers.topdesk.com/explorer/?page=assets#/Assets/getAssets
     */
    public function getNetworking($query = [])
    {
        return $this->request('GET', 'networking', [], $query);
    }

}
