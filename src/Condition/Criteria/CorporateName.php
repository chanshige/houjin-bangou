<?php

declare(strict_types=1);

namespace Chanshige\HoujinBangou\Condition\Criteria;

use Chanshige\HoujinBangou\Condition\AbstractCondition;

final class CorporateName extends AbstractCondition
{
    protected $name;

    public function name(string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function __toString(): string
    {
        return 'name';
    }
}
