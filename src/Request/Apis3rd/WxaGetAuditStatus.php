<?php


namespace VRobin\Weixin3rd\Request\Apis3rd;


use VRobin\Weixin3rd\Request\Request3rd;

class WxaGetAuditStatus extends Request3rd
{
    protected $api = 'wxa/get_auditstatus';
    protected $method = 'POST';

    public function setAuditId($id){
        $this->data['auditid'] = $id;
    }
}