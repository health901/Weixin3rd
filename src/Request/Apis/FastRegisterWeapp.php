<?php


namespace VRobin\Weixin3rd\Request\Apis;


use VRobin\Weixin3rd\Request\Request;

class FastRegisterWeapp extends Request
{
    protected $api = 'component/fastregisterweapp';
    protected $method = 'POST';

    public function setCreate(){
        $this->queryData['action'] = 'create';
    }

    public function setSearch(){
        $this->queryData['action'] = 'search';
    }

    public function setName($name){
        $this->data['name'] = $name;
    }
    public function setCode($value){
        $this->data['code'] = $value;
    }
    public function setCodeType($value){
        $this->data['code_type'] = $value;
    }
    public function setLegalPersonaQechat($value){
        $this->data['legal_persona_wechat'] = $value;
    }
    public function setLegalPersonaName($value){
        $this->data['legal_persona_name'] = $value;
    }
    public function setComponentPhone($value){
        $this->data['component_phone'] = $value;
    }
}