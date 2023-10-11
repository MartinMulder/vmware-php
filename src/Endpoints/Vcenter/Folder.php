<?php

namespace enguerr\VMWare\Endpoints\Vcenter;

trait Folder
{
    public function getListOfFolders($query = [])
    {
        return $this->request('GET', 'folder', [], $query);
    }
}
