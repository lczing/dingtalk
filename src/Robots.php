<?php
namespace Lczing\DingTalk;

class Robots 
{
    private $access_token;
    private $secret;

    public function __construct($access_token, $secret)
    {
        $this->access_token = $access_token;
        $this->secret = $secret;
    }

    public function dingMsg()
    {
        $timestamp      = time() * 1000;
        $string_to_sign = $timestamp . "\n" . $secret;
        $sign           = hash_hmac('sha256', $string_to_sign, $secret, true);
        $sign           = base64_encode($sign);
        $query_data = [
            'access_token' => $access_token,
            'timestamp' => $timestamp,
            'sign' => $sign,
        ];
        $query_string = http_build_query($query_data);

        $data = [
            'msgtype' => 'text',
            'text' => [
                'content'  => $msg,
            ]
        ];

        return $res;
    }

    private function setQueryString()
    {
        
    }

    private function send($query, $data)
    {
        $url = 'https://oapi.dingtalk.com/robot/send?'. $query_string;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array ('Content-Type: application/json;charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 线下环境不用开启curl证书验证, 未调通情况可尝试添加该代码
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}
