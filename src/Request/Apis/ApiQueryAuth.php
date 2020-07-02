<?php


namespace VRobin\Weixin3rd\Request\Apis;


use VRobin\Weixin3rd\Request\Request;

class ApiQueryAuth extends Request
{
    protected $api = 'component/api_query_auth';
    protected $method = 'POST';
    protected $needAppid = true;
    public function setAuthorizationCode($code){
        $this->data['authorization_code'] = $code;
    }
}