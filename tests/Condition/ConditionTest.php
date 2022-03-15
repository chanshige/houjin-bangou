<?php

declare(strict_types=1);

namespace Chanshige\NTA\Condition;

use Chanshige\NTA\Condition\Criteria\CorporateName;
use Chanshige\NTA\Condition\Criteria\CorporateNumber;
use PHPUnit\Framework\TestCase;

class ConditionTest extends TestCase
{
    public function testCorporateNameCondition(): void
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

    public function testCorporateNumberCondition(): void
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
