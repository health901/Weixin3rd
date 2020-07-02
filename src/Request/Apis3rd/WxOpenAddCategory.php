<?php


namespace VRobin\Weixin3rd\Request\Apis3rd;


use VRobin\Weixin3rd\Request\Request3rd;

class WxOpenAddCategory extends Request3rd
{
    protected $api = 'cgi-bin/wxopen/addcategory';
    protected $method = 'POST';
    
    public function setCategories($array){
        $this->data['categories'] = $array;
    }
}