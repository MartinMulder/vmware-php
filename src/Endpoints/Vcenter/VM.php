<?php

namespace MartinMulder\VMWare\Endpoints\Vcenter;

trait VM
{
    public function getListOfVms($query = [])
    {
        return $this->request('GET', 'vm', [], $query);
    }

    public function getVm($name) {
        return $this->request('GET', 'vm/' . $name, []);
    }

}
