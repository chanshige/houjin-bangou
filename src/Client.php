<?php

declare(strict_types=1);

namespace Chanshige\HoujinBangou;

use Chanshige\HoujinBangou\Contracts\ClientInterface;
use Chanshige\HoujinBangou\Contracts\ConditionInterface;
use Chanshige\HoujinBangou\Contracts\ResponseInterface;
use Chanshige\HoujinBangou\Exception\ClientException;
use GuzzleHttp\ClientInterface as GuzzleHttpClientInterface;
use Koriym\HttpConstants\Method;
use Throwable;

final class Client implements ClientInterface
{
    /** @var GuzzleHttpClientInterface $http */
    private $http;

    /** @var string $applicationId */
    private $applicationId;

    public function __construct(GuzzleHttpClientInterface $http, string $applicationId)
    {
        $this->http = $http;
        $this->applicationId = $applicationId;
    }

    public function __invoke(ConditionInterface $condition): ResponseInterface
    {
        try {
            $response = $this->http->request(
                Method::GET,
                $this->baseUriByCondition($condition)
            );

            return new Response($response);
        } catch (Throwable $e) {
            throw new ClientException($e->getMessage(), $e->getCode());
        }
    }

    private function baseUriByCondition(ConditionInterface $condition): string
    {
        return 'https://api.houjin-bangou.nta.go.jp/4/' . $condition . '?'
            . $this->buildByQuery($condition->payload());
    }

    private function buildByQuery(array $payload)
    {
        return http_build_query(array_merge(['id' => $this->applicationId], $payload), '', '&', PHP_QUERY_RFC1738);
    }
}
