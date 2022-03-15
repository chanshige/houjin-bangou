<?php

declare(strict_types=1);

namespace Chanshige\NTA\Contracts;

interface ConditionInterface
{
    public function payload(): array;

    public function __toString(): string;
}
