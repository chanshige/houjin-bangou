<?php

declare(strict_types=1);

namespace Chanshige\HoujinBangou\Condition\Criteria;

use Chanshige\HoujinBangou\Condition\AbstractCondition;

class CorporateNumber extends AbstractCondition
{
    protected $number;

    public function number(int $number)
    {
        $this->number = $number;

        return $this;
    }


    public function __toString(): string
    {
        return 'num';
    }
}
