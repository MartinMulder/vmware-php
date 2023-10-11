<?php

namespace enguerr\VMWare\Endpoints\Vcenter;

trait Datastore
{
    /**
     * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/423e512d-dda1-496f-9de3-851c28ca0814/0e3f6e0d-8d05-4f0c-887b-3d75d981bae5/VMware-vSphere-Automation-SDK-REST-6.7.0/docs/apidocs/index.html#PKG_com.vmware.vcenter.vm
     */
    public function getListOfDatastores($query = [])
    {
        return $this->request('GET', 'datastore', [], $query);
    }

    public function getDatastore($name) {
        return $this->request('GET', 'datastore/' . $name, []);
    }

    public function getDatastorePolicy($name)
    {
        return $this->request('GET', 'datastore/'. $name . '/default-policy', []);
    }
}
