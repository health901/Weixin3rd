<?php


namespace VRobin\Weixin3rd\Request\Apis3rd;


use VRobin\Weixin3rd\Request\Request3rd;

class WxaSetNickName extends Request3rd
{
    protected $api = 'wxa.setnickname';
    protected $method = 'POST';

    public function setNickName($name){
        $this->data['nick_name'] = $name;
    }
    public function setIdCard($v){
        $this->addMedia('id_card',$v);
    }
    public function setLicense($v){
        $this->addMedia('license',$v);
    }
    public function setStuff1($v){
        $this->addMedia('naming_other_stuff_1',$v);
    }
    public function setStuff2($v){
        $this->addMedia('naming_other_stuff_2',$v);
    }
    public function setStuff3($v){
        $this->addMedia('naming_other_stuff_3',$v);
    }
    public function setStuff4($v){
        $this->addMedia('naming_other_stuff_4',$v);
    }
    public function setStuff5($v){
        $this->addMedia('naming_other_stuff_5',$v);
    }
    public function addMedia($key,$media_id){
        $this->data[$key] = $media_id;
    }
}