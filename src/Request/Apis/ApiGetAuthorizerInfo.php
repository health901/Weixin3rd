<?php


namespace VRobin\Weixin3rd\Request\Apis;


use VRobin\Weixin3rd\Request\Request;

class ApiGetAuthorizerInfo extends Request
{
    protected $api = 'component/api_get_authorizer_info';
    protected $method = 'POST';
    protected $needAppid = true;

    public function setAuthorizerAppid($value){
        $this->data['authorizer_appid'] = $value;
    }

}