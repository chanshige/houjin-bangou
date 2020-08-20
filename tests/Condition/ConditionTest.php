<?php

namespace Chanshige\HoujinBangou\Condition;

use Chanshige\HoujinBangou\Condition\Criteria\CorporateName;
use Chanshige\HoujinBangou\Condition\Criteria\CorporateNumber;
use PHPUnit\Framework\TestCase;

class ConditionTest extends TestCase
{
    public function testCorporateNameCondition()
    {
        $expected = [
            'name' => 'テスト名前',
            'type' => 12,
            'history' => 0,
        ];

        $condition = new CorporateName();
        $condition->name('テスト名前');

        $this->assertEquals('name', (string)$condition);
        $this->assertEquals($expected, $condition->payload());
    }

    public function testCorporateNumberCondition()
    {
        $expected = [
            'type' => 12,
            'history' => 0,
            'number' => 1234567890123
        ];

        $condition = new CorporateNumber();
        $condition->number(1234567890123);

        $this->assertEquals('num', (string)$condition);
        $this->assertEquals($expected, $condition->payload());
    }
}
