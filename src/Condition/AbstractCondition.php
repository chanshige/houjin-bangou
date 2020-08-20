<?php

declare(strict_types=1);

namespace Chanshige\HoujinBangou\Condition;

use Chanshige\HoujinBangou\Contracts\ConditionInterface;

abstract class AbstractCondition implements ConditionInterface
{
    /* XML形式 */
    protected $type = 12;

    /* 変更履歴を含めない */
    protected $history = 0;

    public function history(bool $history)
    {
        $this->history = (int)$history;

        return $this;
    }

    public function payload(): array
    {
        return array_filter(get_object_vars($this), function ($value) {
            return $value !== null;
        });
    }
}
