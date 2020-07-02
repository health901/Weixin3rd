<?php


namespace VRobin\Weixin3rd\Request\Apis3rd;


use VRobin\Weixin3rd\Request\Request3rd;

class AccountModifySignature extends Request3rd
{
    protected $api = 'cgi-bin/account/modifysignature';
    protected $method = 'POST';

    public function setSignature($text){
        $this->data['signature'] = $text;
    }
}