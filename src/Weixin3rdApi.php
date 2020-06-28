<?php


namespace VRobin\Weixin3rd;


use VRobin\Weixin\Cache\Cache;
use VRobin\Weixin\Cache\File;
use VRobin\Weixin\Request\ApiSender;
use VRobin\Weixin\Request\Request;
use VRobin\Weixin\Token\TokenCreator;

class Weixin3rdApi
{
    protected $appid;
    protected $secret;
    protected $aesKey;
    protected $tokenCreator;

    /**
     * WeixinApi constructor.
     * @param string $appid
     * @param string $secret
     * @param null $tokenCreator
     * @param null $cacheConfig
     * @throws Exception\WeixinException
     */
    public function __construct($config = [], $tokenCreator = null, $cacheConfig = null)
    {
        $this->appid = $config['appid'];
        $this->secret = $config['secret'];
        $this->aesKey = $config['aesKey'];
        $this->makeService($tokenCreator, $cacheConfig);
    }
    
    
    /**
     * @param null $tokenCreator
     * @param null $cacheConfig
     * @throws Exception\WeixinException
     */
    protected function makeService($tokenCreator = null, $cacheConfig = null)
    {

        $this->tokenCreator = $tokenCreator ? $tokenCreator : new TokenCreator($this->appid, $this->secret);

        if ($cacheConfig) {
            Cache::getStore($cacheConfig['store'], $cacheConfig['config']);
        } else {
            Cache::getStore(File::class, [
                'cacheDir' => __DIR__,
                'cacheFile' => 'weixin.cache'
            ]);
        }
    }
    

    public function receviceTicket(){
        
    }

    public function authorizeUrl($redirect_url, $withUserInfo = false)
    {
        $redirect_url = urlencode($redirect_url);
        $scope = $withUserInfo ? 'snsapi_base' : 'snsapi_userinfo';
        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->appid}&redirect_uri={$redirect_url}&response_type=code&scope={$scope}&state=STATE#wechat_redirect";
    }

    /**
     * @param Request $api
     * @return string
     * @throws Exception\WeixinException|Exception\ApiException|Exception\TokenException
     */
    public function call(Request $api)
    {
        $sender = new ApiSender($this->tokenCreator);
        return $sender->sendRequest($api);
    }
}