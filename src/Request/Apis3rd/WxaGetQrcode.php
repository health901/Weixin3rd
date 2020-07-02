<?php


namespace VRobin\Weixin3rd\Request\Apis3rd;


use VRobin\Weixin3rd\Request\Request3rd;

class WxaGetQrcode extends Request3rd
{
    protected $api = 'wxa/get_qrcode';
    protected $returnRaw = true;

    public function setPath($path){
        $this->data['path'] = $path;
    }
}