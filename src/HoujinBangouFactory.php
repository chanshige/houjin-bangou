<?php

declare(strict_types=1);

namespace Chanshige\NTA;

use Chanshige\NTA\Contracts\HoujinBangouInterface;
use GuzzleHttp\Client;

final class HoujinBangouFactory
{
    public static function newInstance(string $applicationId): HoujinBangouInterface
    {
        return new HoujinBangou(new Client(), $applicationId);
    }
}
