<?php


namespace VRobin\Weixin3rd\Request\Apis;


use VRobin\Weixin3rd\Request\Request;

class CheckWxVerifyNickName extends Request
{
    protected $api = "wxverify/checkwxverifynickname";
    protected $needToken = true;
    protected $method = 'POST';


    /**
     * 链接里的access_token指定为第三方应用的component_access_token
     * @param $token
     */
    public function setComponentAccessToken($token)
    {
        parent::setComponentAccessToken($token);
        $this->accessToken = $token;
    }

    public function setNickName($name){
        $this->data['nick_name'] = $name;
    }
}