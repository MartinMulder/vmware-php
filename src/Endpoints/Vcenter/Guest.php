<?php

namespace MartinMulder\VMWare\Endpoints\Vcenter;

trait Guest
{
    public function getListOfGuests($query = [])
    {
        return $this->request('GET', 'guest/customization-specs', [], $query);
    }
}
