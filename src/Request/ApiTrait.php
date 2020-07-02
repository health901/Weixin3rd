<?php


namespace VRobin\Weixin3rd\Request;


use VRobin\Weixin\Exception\ApiException;
use VRobin\Weixin\Request\Http\Request;

trait ApiTrait
{
    /**
     *
     * @param string $url
     * @param array $data
     * @param string $method
     * @return string
     * @throws ApiException
     */
    public function request($url, $data = array(), $method = 'get', $raw = false)
    {
//        dump($url,$data);
        if ($method == 'post') {
            $result = $this->post($url, $data);
        } else {
            $result = $this->get($url, $data);
        }
        $res = json_decode($result, true);
        if (isset($res['errcode']) && $res['errcode']) {
            throw new ApiException($res['errcode']. ':' .$res['errmsg'], $res['errcode']);
        }
        return $raw ? $result : $res;
    }

    protected function get($api, $data)
    {
        return Request::get($api, $data);
    }

    protected function post($api, $data)
    {
        return Request::post($api, $data);
    }
}