<?php

namespace MartinMulder\VMWare\Endpoints\Vcenter;

trait Resourcepool
{
    public function getListOfResourcepools($query = [])
    {
        return $this->request('GET', 'resource-pool', [], $query);
    }

    public function getResourcepool($name) {
        return $this->request('GET', 'resource-pool/' . $name, []);
    }

}
