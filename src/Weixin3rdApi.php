<?php


namespace VRobin\Weixin3rd;


use VRobin\Weixin\Cache\Cache;
use VRobin\Weixin\Cache\File;
use VRobin\Weixin3rd\Message\Responser;
use VRobin\Weixin3rd\Request\Apis\ApiCreatePreauthcode;
use VRobin\Weixin3rd\Request\ApiSender;
use VRobin\Weixin3rd\Request\Request;
use VRobin\Weixin3rd\Token\TokenCreator;

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
    

    public function onMessage($callbacks = []){
        $response = new Responser($this->aesKey);
        $response->setCallbacks($callbacks);
        $response->listen();
    }

    public function authorizeUrl($redirect_url, $auth_type = "",$biz_appid = "")
    {
        $token = $this->getToken();
        $pre_auth_code = $this->getPreCode();
        $redirect_url = urlencode($redirect_url);
        return "https://mp.weixin.qq.com/cgi-bin/componentloginpage?component_appid={$this->appid}&pre_auth_code={$pre_auth_code}&redirect_uri={$redirect_url}&auth_type={$auth_type}&biz_appid={$biz_appid}";
    }

    public function getPreCode(){
        $cache = Cache::get('precode.'.$this->appid);
        if($cache && $cache['expire'] > time()){
            return $cache['pre_auth_code'];
        }
        $api = new ApiCreatePreauthcode();
        $api->setComponentAppid($this->appid);
        $preCodeResult = $this->call($api);
        $cache = [
            'pre_auth_code'=>$preCodeResult['pre_auth_code'],
            'expire'=>$preCodeResult['expires_in']+time()
        ];
        Cache::set('precode.'.$this->appid,$cache);
        return $preCodeResult['pre_auth_code'];
    }

    /**
     * @param Request $api
     * @return string
     * @throws Exception\WeixinException|Exception\ApiException|Exception\TokenException
     */
    public function call(Request $api)
    {
        $sender = new ApiSender($this->appid, $this->tokenCreator);
        return $sender->sendRequest($api);
    }

    public function getToken(){
        return $this->tokenCreator->getToken();
    }
}