<?php

namespace Chanshige\HoujinBangou\Contracts;

interface ConditionInterface
{
    public function payload(): array;

    public function __toString(): string;
}
