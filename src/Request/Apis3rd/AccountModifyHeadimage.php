<?php


namespace VRobin\Weixin3rd\Request\Apis3rd;


use VRobin\Weixin3rd\Request\Request3rd;

class AccountModifyHeadimage extends Request3rd
{
    protected $api = 'cgi-bin/account/modifyheadimage';
    protected $method = 'POST';

    public function setHeadImage($id){
        $this->data['head_img_media_id'] = $id;
    }

    /**
     * 设置裁切区域
     * @param float $x2
     * @param float $y2
     * @param float $x1
     * @param float $y1
     */
    public function setCutArea($x2, $y2, $x1 = 0, $y1 = 0){
        $this->data['x1'] = $x1;
        $this->data['x2'] = $x2;
        $this->data['y1'] = $y1;
        $this->data['y2'] = $y2;
    }
}