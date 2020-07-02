<?php


namespace VRobin\Weixin3rd\Request\Apis3rd;


use VRobin\Weixin3rd\Request\Request3rd;

class WxaSubmitAudit extends Request3rd
{
    protected $api = 'wxa/submit_audit';
    protected $method = 'POST';

    public function setVersionDesc($string){
        $this->data['version_desc'] = $string;
    }
    public function setFeedbackInfo($string){
        $this->data['feedback_info'] = $string;
    }
    public function setFeedbackStuff($mixed){
        $this->data['feedback_stuff'] = is_array($mixed) ? implode("|",$mixed) : $mixed;
    }

    public function setItemList($array){
        $this->data['item_list'] = $array;
    }

    public function setPreviewInfo($array){
        $this->data['preview_info'] = $array;
    }

    public function setUgcDeclare($array){
        $this->data['ugc_declare'] = $array;
    }
}