[![Packagist](https://img.shields.io/badge/packagist-v1.0.2-blue.svg)](https://github.com/chanshige/houjin-bangou)
[![Build Status](https://travis-ci.com/chanshige/houjin-bangou.svg?branch=master)](https://travis-ci.com/chanshige/houjin-bangou)
[![Coverage Status](https://coveralls.io/repos/github/chanshige/houjin-bangou/badge.svg)](https://coveralls.io/github/chanshige/houjin-bangou)

# houjin-bangou
'chanshige/houjin-bangou' is that helps search for corporate information registered in the NTA(National Tax Agency)
  
法人番号システム Web-API を便利に使うライブラリです  

@see https://www.houjin-bangou.nta.go.jp/webapi/

※ Web-APIを利用するためには、アプリケーションIDが必要です。 
※ Laravelで利用する際のProvider登録サンプルを記載しております。 

## Installation
with composer
```shell script
$ composer require chanshige/houjin-bangou
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
#### create ServiceProvider class.
```

use Chanshige\HoujinBangou\Client;
use Chanshige\HoujinBangou\Contracts\ClientInterface;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\ServiceProvider;

class HoujinBangouServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ClientInterface::class, function () {
            return new Client(
                new GuzzleClient(),
                config('services.houjin_bangou.application_id')
            );
        });
    }

    public function provides()
    {
        return [
            ClientInterface::class
        ];
    }
}
```

#### append providers to config/app.php
```
'providers' => [
    App\Providers\HoujinBangouServiceProvider::class    
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
