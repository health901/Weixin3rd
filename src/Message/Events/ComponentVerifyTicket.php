<?php

namespace VRobin\Weixin3rd\Message\Events;

use VRobin\Weixin\Cache\Cache;
use VRobin\Weixin3rd\Message\Event;

class ComponentVerifyTicket extends Event
{
    public function run()
    {
        $cacheKey = 'ticket.'.$this->data->AppId;
        Cache::set($cacheKey,$this->data->ComponentVerifyTicket);
    }
}