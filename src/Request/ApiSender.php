<?php


namespace VRobin\Weixin3rd\Request;


use VRobin\Weixin\Exception\{ApiException, TokenException, WeixinException};
use VRobin\Weixin\Token\TokenInterface;
use VRobin\Weixin3rd\Request\Request as Api;

class ApiSender
{
    use ApiTrait;

    protected $appid;
    /**
     * @var TokenInterface
     */
    protected $tokenCreator;

    public function __construct($appid = "", $tokenCreator = null)
    {
        $this->appid = $appid;
        if ($tokenCreator && $tokenCreator instanceof TokenInterface) {
            $this->tokenCreator = $tokenCreator;
        }
    }

    /**
     * @param Request $api
     * @return string
     * @throws TokenException
     * @throws WeixinException
     * @throws ApiException
     */
    public function sendRequest(Api $api)
    {
        if ($api->isNeedToken()) {
            $componentAccessToken = $this->tokenCreator->getToken();
            if (!$componentAccessToken) {
                throw new TokenException("Cannot get componentAccessToken");
            }
            $api->setComponentAccessToken($componentAccessToken);
        }
        if($api->isNeedAppid()){
            $api->setComponentAppid($this->appid);
        }
        return $this->request($api->getApi(), $api->getData(), $api->getMethod(), $api->returnRaw());
    }
}