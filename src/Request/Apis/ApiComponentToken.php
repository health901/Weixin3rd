<?php

namespace VRobin\Weixin3rd\Request\Apis;

use VRobin\Weixin3rd\Request\Request;

class ApiComponentToken extends Request
{
    protected $api = 'component/api_component_token';
    protected $method = 'POST';
    protected $needToken = false;
    protected $needAppid = true;
    
    public function setComponentAppsecret($appsecret){
        $this->data['component_appsecret'] = $appsecret;
    }

    public function setComponentVerifyTicket($ticket){
        $this->data['component_verify_ticket'] = $ticket;
    }
}