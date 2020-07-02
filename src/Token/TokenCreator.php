<?php


namespace VRobin\Weixin3rd\Token;


use VRobin\Weixin\Cache\Cache;
use VRobin\Weixin\Token\TokenInterface;
use VRobin\Weixin\Exception\{ApiException, TokenException, WeixinException};
use VRobin\Weixin3rd\Request\Apis\ApiComponentToken;
use VRobin\Weixin3rd\Request\ApiSender;

class TokenCreator implements TokenInterface
{
    protected $appid;
    protected $secret;

    public function __construct(string $appid, string $secret)
    {
        $this->appid = $appid;
        $this->secret = $secret;
    }

    /**
     * @return mixed
     * @throws ApiException
     * @throws TokenException
     * @throws WeixinException
     */
    public function getToken()
    {
        $cache = Cache::get('acccessToken', '');
        if ($cache && $cache['appid'] == $this->appid && $cache['expire'] > time()) {
            return $cache['acccessToken'];
        }
        $data = $this->request();
        $expire = time() + $data['expires_in'] - 200;
        $accessToken = array('acccessToken' => $data['component_access_token'], 'expire' => $expire, 'appid' => $this->appid);
        Cache::set('acccessToken', $accessToken);
        return $data['component_access_token'];
    }

    /**
     * @return string
     * @throws ApiException
     * @throws TokenException
     * @throws WeixinException
     */
    protected function request()
    {
        $ticket = Cache::get('ticket.'.$this->appid);
        if(!$ticket){
            return;
        }
        $api = new ApiComponentToken();
        $api->setComponentAppsecret($this->secret);
        $api->setComponentVerifyTicket($ticket);

        $sender = new ApiSender($this->appid);
        return $sender->sendRequest($api);
    }

}