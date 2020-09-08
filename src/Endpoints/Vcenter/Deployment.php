<?php

namespace MartinMulder\VMWare\Endpoints\Vcenter;

trait Deployment
{
    public function getDeployment($query = []) {
        return $this->request('GET', 'deployment', [], $query);
    }

    public function rollbackDeployment()
    {
        return $this->getDeployment(['action' => 'rollback']);
    }
}
