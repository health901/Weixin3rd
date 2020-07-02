<?php


namespace VRobin\Weixin3rd\Message;


abstract class Event
{
    protected $data;
    
    public function __construct(Result $result)
    {
        $this->data = $result;
    }

    public function run(){

    }
}