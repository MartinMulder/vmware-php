<?php

namespace enguerr\VMWare\Endpoints\Inventory;

trait Datastore
{
    /**
     * @see https://vdc-download.vmware.com/vmwb-repository/dcr-public/423e512d-dda1-496f-9de3-851c28ca0814/0e3f6e0d-8d05-4f0c-887b-3d75d981bae5/VMware-vSphere-Automation-SDK-REST-6.7.0/docs/apidocs/index.html#PKG_com.vmware.vcenter.vm
     */
    public function findDatastores($query = [])
    {
	$query['~action'] = 'find';
        return $this->request('POST', 'datastore', ['datastores' => ['DAS SRVR210']], $query);
    }
}
