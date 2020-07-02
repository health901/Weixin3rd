<?php


namespace VRobin\Weixin3rd\Request\Apis;


use VRobin\Weixin3rd\Request\Request;

class ApiAuthorizerToken extends Request
{
    protected $api='component/api_authorizer_token';
    protected $method = 'POST';
    protected $needAppid = true;

    public function setAuthorizerAppid($value){
        $this->data['authorizer_appid'] = $value;
    }

    public function setRefreshToken($value){
        $this->data['authorizer_refresh_token'] = $value;
    }
}