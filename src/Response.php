<?php

declare(strict_types=1);

namespace Chanshige\NTA;

use Chanshige\NTA\Contracts\ResponseInterface;
use Laminas\Xml2Json\Xml2Json;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class Response implements ResponseInterface
{
    public function __construct(
        private PsrResponseInterface $response
    ) {
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
