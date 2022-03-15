<?php

declare(strict_types=1);

namespace Chanshige\NTA\Contracts;

interface HoujinBangouInterface
{
    public function __invoke(ConditionInterface $condition): ResponseInterface;
}
