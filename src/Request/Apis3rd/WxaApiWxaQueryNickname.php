<?php


namespace VRobin\Weixin3rd\Request\Apis3rd;


use VRobin\Weixin3rd\Request\Request3rd;

class WxaApiWxaQueryNickname extends Request3rd
{
    protected $api = 'wxa/api_wxa_querynickname';
    protected $method = 'POST';

    public function setAuditId($id){
        $this->data['audit_id'] = $id;
    }
}