<?php

declare(strict_types=1);

namespace Chanshige\NTA\Condition\Criteria;

use Chanshige\NTA\Condition\AbstractCondition;

final class CorporateName extends AbstractCondition
{
    protected string $name;

    public function name(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString(): string
    {
        return 'name';
    }
}
