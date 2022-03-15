<?php

declare(strict_types=1);

namespace Chanshige\NTA\Condition\Criteria;

use Chanshige\NTA\Condition\AbstractCondition;

class CorporateNumber extends AbstractCondition
{
    protected int $number;

    public function number(int $number): self
    {
        $this->number = $number;

        return $this;
    }


    public function __toString(): string
    {
        return 'num';
    }
}
