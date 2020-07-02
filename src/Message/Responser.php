<?php


namespace VRobin\Weixin3rd\Message;


class Responser
{

    /**
     *
     * @var Result
     */
    protected $data;
    protected $aesKey;
    protected $callbacks = [];
    protected $xml;
    protected $responseLock = False;
    protected $sender;

    /**
     * Responser constructor.
     * @param $token
     */
    public function __construct($aesKey)
    {
        $this->aesKey = $aesKey;
    }

    public function setCallback($event,$class){
        $this->callbacks[$event] = $class;
    }

    public function setCallbacks($data){
        foreach ($data as $e=>$c){
            $this->setCallback($e,$c);
        }
    }

    /**
     * 监听用户消息
     */
    public function listen()
    {
        $data = file_get_contents("php://input");
        if (!$data) {
            return;
        }
        $result = new Result($data,$this->aesKey);
        if(!$result){
            return;
        }
        
        $this->data = $result;
        $infoType =  $result->InfoType ? $result->InfoType : $result->Event;
        if(key_exists($infoType,$this->callbacks)){
            $nClass = $this->callbacks[$infoType];
            $event = new $nClass($this->data);
            $event->run();
        }else{
            $class = str_replace(" ","",ucwords(str_replace("_"," ",$infoType)));
            if(file_exists(__DIR__.'/Events/'.$class.'.php')){
                $nClass = 'VRobin\\Weixin3rd\\Message\\Events\\'.$class;
                $event = new $nClass($this->data);
                $event->run();
            }
        }
        echo 'success';
        exit;
    }

}