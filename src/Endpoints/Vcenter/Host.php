<?php

namespace MartinMulder\VMWare\Endpoints\Vcenter;

trait Host
{
    public function getListOfHosts($query = [])
    {
        return $this->request('GET', 'host', [], $query);
    }

    public function connectToHost($name)
    {
        return $this->request('POST', 'host/' . $name . '/connect' , [], $query); 
    }

    public function disconnectFromHost($name)
    {
        return $this->request('POST', 'host/' . $name . '/disconnect' , [], $query); 
    }
}
