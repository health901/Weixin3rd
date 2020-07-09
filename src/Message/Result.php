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
        $this->key = base64_decode($key . '=');
        if($this->Encrypt){
            $this->aesDecode();
        }
    }

    public function __get($name)
    {
        if (property_exists($this->xml, $name)) {
            return $this->xml->$name;
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
        $iv = substr($this->key, 0, 16);
        $decrypted = openssl_decrypt($this->Encrypt,'AES-256-CBC',substr($this->key, 0, 32),OPENSSL_ZERO_PADDING,$iv);
        $result = $this->decode($decrypted);
        if (strlen($result) < 16)
            return "";
        $content = substr($result, 16, strlen($result));
        $len_list = unpack("N", substr($content, 0, 4));
        $xml_len = $len_list[1];
        $xml_content = substr($content, 4, $xml_len);
        $xml = simplexml_load_string($xml_content, 'SimpleXMLElement', LIBXML_NOCDATA);
        $this->xml = json_decode(json_encode($xml));
    }

    /**
     * 对解密后的明文进行补位删除
     * @param decrypted 解密后的明文
     * @return 删除填充补位后的明文
     */
    protected function decode($text)
    {

        $pad = ord(substr($text, -1));
        if ($pad < 1 || $pad > 32) {
            $pad = 0;
        }
        return substr($text, 0, (strlen($text) - $pad));
    }
}
