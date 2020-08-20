[![Packagist](https://img.shields.io/badge/packagist-v1.0.1-blue.svg)](https://github.com/chanshige/houjin-bangou)
[![Build Status](https://travis-ci.com/chanshige/houjin-bangou.svg?branch=master)](https://travis-ci.com/chanshige/houjin-bangou)
[![Coverage Status](https://coveralls.io/repos/github/chanshige/houjin-bangou/badge.svg)](https://coveralls.io/github/chanshige/houjin-bangou)

# houjin-bangou
'chanshige/houjin-bangou' is that helps search for corporate information registered in the NTA(National Tax Agency)
  
法人番号システム Web-API を便利に使うライブラリです  
※ Web-APIを利用するためには、アプリケーションIDが必要です。

@see https://www.houjin-bangou.nta.go.jp/webapi/

## Installation
without packagist
```shell script
$ composer config repositories.chanshige/houjin-bangou vcs https://github.com/chanshige/houjin-bangou.git
$ composer require chanshige/houjin-bangou:^1.0
```

## Usage
```php
<?php
require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client as GuzzleClient;
use Chanshige\HoujinBangou\Client;
use Chanshige\HoujinBangou\Condition\Criteria\CorporateName;

$houjin = new Client(new GuzzleClient(), '国税庁より発行されたアプリケーションID');

$condition = new CorporateName();
$condition->name('カラビナテクノロジー');
$response = $houjin($condition);

echo $response->body(); //XML(Original)
// or $response->toJson();
// or $response->toArray();
```
### for Laravel
#### add ServiceProvider
```
'providers' => [
    Chanshige\HoujinBangou\Laravel\ClientServiceProvider::class    
]
```

#### add .env
```
HOUJIN_BANGOU_APPLICATION_ID='*************'
```

#### add config/services.php
```
'houjin_bangou' => [
    'application_id' => env('HOUJIN_BANGOU_APPLICATION_ID')
]
```
