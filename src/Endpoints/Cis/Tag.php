<?php

namespace enguerr\VMWare\Endpoints\Cis;

trait Tag
{
    public function deleteTag($id)
    {
        return $this->request('DELETE', 'tagging/tag/'.$id);
    }
    public function editTag($id,$name,$description='')
    {
        $json = array("description"=>$description,"name"=>$name);
        return $this->request('PATCH', 'tagging/tag/'.$id, $json);
    }
    public function createTag($name,$cid,$description='')
    {
        $json = array("category_id"=>$cid,"description"=>$description,"name"=>$name);
        return $this->request('POST', 'tagging/tag', $json, []);
    }
    public function getListOfTags()
    {
        return $this->request('GET', 'tagging/tag', []);
    }

    public function getTag($id)
    {
        return $this->request('GET', 'tagging/tag/' . $id, [], []);
    }

    public function getTagAssociations($id)
    {
        return $this->request('POST', 'tagging/tag-association/' . $id . '', array("action"=>"list-attached-objects"));
    }

    public function getListOfTagAssociations($id)
    {
        $json = array("tag_ids"=> array($id));
        return $this->request('POST', 'tagging/tag-association', $json, array("action"=>"list-attached-objects"));
    }
    public function setMultiTagAssociations($id,$vms)
    {
        $json = array("object_ids"=> []);
        foreach ($vms as $vm){
            array_push($json['object_ids'],array("id"=>$vm,"type"=>"VirtualMachine"));
        }
        return $this->request('POST', 'tagging/tag-association/'.$id.'', $json, array("action"=>"attach-tag-to-multiple-objects"));
    }
    public function getListOfVmTagAssociations($id)
    {
        $json = array("object_id"=> array("id"=>$id,"type"=>"VirtualMachine"));
        return $this->request('POST', 'tagging/tag-association', $json, array("action"=>"list-attached-tags"));
    }

}
