<?php


namespace VRobin\Weixin3rd\Request\Apis3rd;


use VRobin\Weixin3rd\Request\Request3rd;

class WxaModifyDomain extends Request3rd
{
    protected $api = 'wxa/modify_domain';
    protected $method = 'POST';

    public function setAction($action){
        $this->data['action'] = $action;
    }

    public function setRequestdomain($array){
        $this->data['requestdomain'] = $array;
    }
    public function setWsrequestdomain($array){
        $this->data['wsrequestdomain'] = $array;
    }
    public function setUploaddomain($array){
        $this->data['uploaddomain'] = $array;
    }
    public function setDownloaddomain($array){
        $this->data['downloaddomain'] = $array;
    }
}