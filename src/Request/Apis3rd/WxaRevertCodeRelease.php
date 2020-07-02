<?php


namespace VRobin\Weixin3rd\Request\Apis3rd;


use VRobin\Weixin3rd\Request\Request3rd;

class WxaRevertCodeRelease extends Request3rd
{
    protected $api = 'wxa/revertcoderelease';
    protected $needToken = false;
    protected $needAccessToken = true;
}