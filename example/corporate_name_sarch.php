<?php

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client as GuzzleClient;
use Chanshige\HoujinBangou\Client;
use Chanshige\HoujinBangou\Condition\Criteria\CorporateName;

$houjin = new Client(new GuzzleClient(), 'application_id');

$condition = new CorporateName();
$condition->name('カラビナテクノロジー');
$response = $houjin($condition);

$result = $response->toArray();

// 法人名
echo $result['corporations']['corporation']['name'];
// 法人名(カナ)
echo $result['corporations']['corporation']['furigana'];
