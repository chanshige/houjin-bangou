<?php

declare(strict_types=1);

namespace Chanshige\NTA\Condition;

use Chanshige\NTA\Contracts\ConditionInterface;

abstract class AbstractCondition implements ConditionInterface
{
    /* XML形式 */
    protected int $type = 12;

    /* 変更履歴を含めない */
    protected int $history = 0;

    public function history(bool $history): self
    {
        $this->history = (int) $history;

        return $this;
    }

    public function payload(): array
    {
        return array_filter(get_object_vars($this), static function ($value) {
            return $value !== null;
        });
    }
}
