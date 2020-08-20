<?php

namespace Chanshige\HoujinBangou\Contracts;

interface ClientInterface
{
    public function __invoke(ConditionInterface $condition): ResponseInterface;
}
