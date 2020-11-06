<?php
namespace Lczing\DingTalk;

class Robots 
{
    private $access_token;
    private $secret;
    private $url;

    public function __construct($access_token, $secret)
    {
        $this->access_token = $access_token;
        $this->secret = $secret;
    }

    public function dingMsg($msg)
    {
        $data = [
            'msgtype' => 'text',
            'text' => [
                'content'  => $msg,
            ]
        ];

        $res = $this->send($data);

        return $res;
    }

    private function setUrl()
    {
        // 设置url
        $timestamp      = time() * 1000;
        $string_to_sign = $timestamp . "\n" . $this->secret;
        $sign           = hash_hmac('sha256', $string_to_sign, $this->secret, true);
        $sign           = base64_encode($sign);
        $query_data = [
            'access_token' => $this->access_token,
            'timestamp' => $timestamp,
            'sign' => $sign,
        ];
        $query_string = http_build_query($query_data);

        $this->url = 'https://oapi.dingtalk.com/robot/send?'. $query_string;
    }

    private function send($data)
    {
        // 设置url
        $this->setUrl();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json;charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }
}
