<?php


namespace VRobin\Weixin3rd\Request\Apis3rd;


use VRobin\Weixin3rd\Request\Request3rd;

class CheckWxVerifyNickName extends Request3rd
{
    protected $api = "cgi-bin/wxverify/checkwxverifynickname";
    protected $method = 'POST';

    public function setNickName($name){
        $this->data['nick_name'] = $name;
    }
}