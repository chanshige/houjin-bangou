<?php

declare(strict_types=1);

namespace Chanshige\HoujinBangou;

use Chanshige\HoujinBangou\Contracts\ResponseInterface;
use Laminas\Xml2Json\Xml2Json;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class Response implements ResponseInterface
{
    /** @var PsrResponseInterface $response */
    private $response;

    public function __construct(PsrResponseInterface $response)
    {
        $this->response = $response;
    }

    public function statusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function headers(): array
    {
        return $this->response->getHeaders();
    }

    public function body(): string
    {
        return (string)$this->response->getBody();
    }

    public function toJson(): string
    {
        return Xml2Json::fromXml($this->body());
    }

    public function toArray(): array
    {
        return json_decode($this->toJson(), true);
    }
}
