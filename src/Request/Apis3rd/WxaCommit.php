<?php


namespace VRobin\Weixin3rd\Request\Apis3rd;


use VRobin\Weixin3rd\Request\Request3rd;

class WxaCommit extends Request3rd
{
    protected $api = 'wxa/commit';
    protected $method = 'POST';


    public function setTemplateId($id){
        $this->data['template_id'] = $id;
    }

    public function setExtJson($json){
        $this->data['ext_json'] = $json;
    }
    public function setVersion($version){
        $this->data['user_version'] = $version;
    }
    public function setDesc($desc){
        $this->data['user_desc'] = $desc;
    }
}