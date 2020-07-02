<?php
namespace VRobin\Weixin3rd\Message;
/**
 * 接受消息结果辅助类
 * @author Viking Robin <admin@vkrobin.com>
 */

/**
 * @property-read Object $xml            SimpleXML格式消息
 * @property-read string $AppId             APPID
 * @property-read string $Encrypt           加密数据
 * @property-read string $InfoType          消息类型
 *
 */
class Result
{

    protected $xml;
    protected $key;

    public function __construct($xml, $key = '')
    {
        $xml = simplexml_load_string($xml, \SimpleXMLElement::class, LIBXML_NOCDATA);
        $this->xml = json_decode(json_encode($xml));
        $this->key = $key;
        if($this->Encrypt){
            $this->aesDecode();
        }
    }

    public function __get($name)
    {
        if (property_exists($this->xml, $name)) {
            return$this->xml->$name;
        }

        $method = 'get' . $name;
        if (method_exists($this, $method)) {
            return $this->$method();
        }
        return null;
    }

    /**
     * @return Object
     */
    public function getXml()
    {
        return $this->xml;
    }

    protected function aesDecode(){
        $key = $this->key.'=';
        $result = openssl_decrypt(base64_decode($this->Encrypt), 'AES-256-CBC', base64_decode($key), OPENSSL_RAW_DATA);

        if (strlen($result) < 16)
            return "";
        $content = substr($result, 16, strlen($result));
        $len_list = unpack("N", substr($content, 0, 4));
        $xml_len = $len_list[1];
        $xml_content = substr($content, 4, $xml_len);
        $this->xml = simplexml_load_string($xml_content, 'SimpleXMLElement', LIBXML_NOCDATA);
    }
}
