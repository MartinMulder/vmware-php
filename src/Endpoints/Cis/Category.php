<?php

namespace MartinMulder\VMWare\Endpoints\Cis;

trait Category{
    public function editCategory($id,$name,$description='')
    {
        $json = array("description"=>$description,"name"=>$name);
        return $this->request('PATCH', 'tagging/category/'.$id, $json, []);
    }
    public function getListOfCategoryTags()
    {
        return $this->request('GET', 'tagging/category', []);
    }
    public function createCategory($name,$description='')
    {
        $json = array("associable_types"=>array("VirtualMachine"),"cardinality"=>"SINGLE","name"=>$name,"description"=>$description);
        return $this->request('POST', 'tagging/category', $json, []);
    }
    public function getCategoryTags($id)
    {
        return $this->request('GET', 'tagging/category/'.$id, [], []);
    }
}