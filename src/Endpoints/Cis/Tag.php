<?php

namespace MartinMulder\VMWare\Endpoints\Cis;

trait Tag
{
    public function createTag($name,$cid)
    {
        $json = array("create_spec"=> array("category_id"=>$cid,"description"=>"","name"=>$name));
        return $this->request('POST', 'tagging/tag', $json, []);
    }
    public function getListOfTags($query)
    {
        return $this->request('GET', 'tagging/tag', [], $query);
    }
    public function getTag($id)
    {
        return $this->request('GET', 'tagging/tag/id:'.$id, [], []);
    }
    public function getTagAssociations($id)
    {
        return $this->request('POST', 'tagging/tag-association/id:'.$id.'', ['{}'], ["~action" =>"list-attached-objects"]);
    }
    public function setMultiTagAssociations($id,$vms)
    {
        $json = array("object_ids"=> []);
        foreach ($vms as $vm){
            array_push($json['object_ids'],array("id"=>$vm,"type"=>"VirtualMachine"));
        }
        return $this->request('POST', 'tagging/tag-association/id:'.$id.'', $json, ["~action" =>"attach-tag-to-multiple-objects"]);
    }
    public function getListOfVmTagAssociations($id)
    {
        $json = '{
    "object_ids": [
        {
            "id":"' . $id . '",
            "type": "VirtualMachine"
        }
    ]
}';
        return $this->request('POST', 'tagging/tag-association', array(json_decode($json)), ["~action" => "list-attached-tags-on-objects"], array('Content-type: application/json'));
    }
}
