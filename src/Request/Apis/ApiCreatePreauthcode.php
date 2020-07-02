<?php


namespace VRobin\Weixin3rd\Request\Apis;


use VRobin\Weixin3rd\Request\Request;

class ApiCreatePreauthcode extends Request
{
    protected $api = 'component/api_create_preauthcode';
    protected $method = 'POST';
    protected $needAppid = true;
}