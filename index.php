<?php
include './src/Robots.php';

$access_token = 'your acces token';
$secret = 'your secret';

$ro = new Lczing\DingTalk\Robots($access_token, $secret);
$ro->dingMsg('test');