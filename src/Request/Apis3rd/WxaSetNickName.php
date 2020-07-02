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
    public function setStuffs($array){
        for($i=1; $i<=max(count($array),5); $i++){
            $name = 'naming_other_stuff_'.$i;
            $this->addMedia($name,$v);
        }
    }
    public function addMedia($key,$media_id){
        $this->data[$key] = $media_id;
    }
}