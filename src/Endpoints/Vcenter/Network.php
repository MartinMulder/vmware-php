<?php

namespace MartinMulder\VMWare\Endpoints\Vcenter;

trait Network
{
    public function getListOfNetworks($query = [])
    {
        return $this->request('GET', 'network', [], $query);
    }

    public function getNetwork($network) 
    {
	$filters['filter.networks'] = $network;

        return $this->getListOfNetworks($filters);
    }
}
