<?php

namespace enguerr\VMWare\Endpoints\Vcenter;

trait Cluster
{
    public function getListOfClusters($query = [])
    {
        return $this->request('GET', 'cluster', [], $query);
    }

    public function getCluster($name) {
        return $this->request('GET', 'cluster/' . $name, []);
    }

}
