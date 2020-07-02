<?php


namespace VRobin\Weixin3rd\Request;


class Request3rd extends Request
{
    protected $apiUrl = 'https://api.weixin.qq.com/';

    protected $needToken = false;
    protected $needAccessToken = true;
    protected $postJson = true;

    protected function apiUrl()
    {
        $url = $this->apiUrl . $this->api;
        if ($this->accessToken) {
            $this->queryData['access_token'] = $this->accessToken;
        }
        if($this->queryData){
            $url .= '?' . http_build_query($this->queryData);
        }
        return $url;
    }
}