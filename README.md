# dingtalk

## Introduction

钉钉推送

## Install

```
$ composer require lczing/dingtalk
```

## Demo

```php
<?php

require __DIR__ . '/vendor/autoload.php';

$access_token = 'your acces token';
$secret = 'your secret';

$ro = new Lczing\DingTalk\Robots($access_token, $secret);
$ro->dingMsg('test');
```