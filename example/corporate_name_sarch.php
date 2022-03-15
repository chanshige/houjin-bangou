<?php

require __DIR__ . '/../vendor/autoload.php';

use Chanshige\NTA\HoujinBangouFactory;
use Chanshige\NTA\Condition\Criteria\CorporateName;

$houjin =  HoujinBangouFactory::newInstance('application_id');

$condition = new CorporateName();
$condition->name('カラビナテクノロジー');
$response = $houjin($condition);

$result = $response->toArray();

// 法人名
echo $result['corporations']['corporation']['name'];
// 法人名(カナ)
echo $result['corporations']['corporation']['furigana'];
