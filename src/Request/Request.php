<?php


namespace VRobin\Weixin3rd\Request;


class Request
{
    protected $apiUrl = "https://api.weixin.qq.com/cgi-bin/";

    protected $api;

    protected $data = [];

    protected $queryData = [];

    protected $method = 'GET';

    //第三方token
    protected $needToken = true;

    //应用token
    protected $needAccessToken = false;

    protected $needAppid = false;

    protected $postJson = true;

    protected $accessToken;

    protected $componentAccessToken;

    protected $returnRaw = false;

    public function __set($name, $value)
    {
        $method = 'set'.ucfirst($name);
        if(method_exists($this,$method)){
            $this->$method($value);
            return;
        }
        $this->data[$name] = $value;
    }

    protected function postJson(){
        return $this->method == 'GET' ? false : ($this->data ? $this->postJson : false);
    }

    public function getData()
    {
        return $this->postJson() ? json_encode($this->data, JSON_UNESCAPED_UNICODE) : $this->data;
    }

    public function isNeedToken()
    {
        return $this->needToken;
    }
    public function isNeedAccessToken()
    {
        return $this->needAccessToken;
    }
    public function isNeedAppid(){
        return $this->needAppid;
    }

    public function returnRaw(){
        return $this->returnRaw;
    }

    public function setComponentAccessToken($token){
        $this->componentAccessToken = $token;
    }

    public function setComponentAppid($appid){
        $this->data['component_appid'] = $appid;
    }

    public function getApi()
    {
        return $this->apiUrl();
    }

    public function getMethod()
    {
        return strtolower($this->method);
    }

    public function getAccessToken(){
        return $this->accessToken;
    }

    public function setAccessToken($token){
        $this->accessToken = $token;
    }

    protected function apiUrl()
    {
        $url = $this->apiUrl . $this->api;
        if ($this->isNeedToken()) {
            $this->queryData['component_access_token'] = $this->componentAccessToken;
        }
        if($this->queryData){
            $url .= '?' . http_build_query($this->queryData);
        }
        return $url;
    }
}