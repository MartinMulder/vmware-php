<?php

namespace MartinMulder\VMWare\Endpoints\Cis;

trait Tag
{
    public function getListOfCategoryTags($query)
    {
        return $this->request('GET', 'tagging/category', [], $query);
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
}
