<?php

namespace MartinMulder\VMWare\Endpoints\Cis;

trait Category{
    public function getListOfCategoryTags($query)
    {
        return $this->request('GET', 'tagging/category', [], $query);
    }
    public function getCategoryTags($id)
    {
        return $this->request('GET', 'tagging/category/id:'.$id, [], []);
    }
}