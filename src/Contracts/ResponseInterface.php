<?php

namespace Chanshige\HoujinBangou\Contracts;

interface ResponseInterface
{
    public function statusCode(): int;

    public function headers(): array;

    public function body(): string;

    public function toJson(): string;

    public function toArray(): array;
}
