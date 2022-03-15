<?php

declare(strict_types=1);

namespace Chanshige\NTA;

use Chanshige\NTA\Contracts\HoujinBangouInterface;
use Chanshige\NTA\Contracts\ConditionInterface;
use Chanshige\NTA\Contracts\ResponseInterface;
use Chanshige\NTA\Exception\HoujinBangouException;
use GuzzleHttp\ClientInterface as GuzzleHttpClientInterface;
use Koriym\HttpConstants\Method;
use Throwable;

final class HoujinBangou implements HoujinBangouInterface
{
    public function __construct(
        private GuzzleHttpClientInterface $http,
        private string $applicationId
    ) {
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
            throw new HoujinBangouException($e->getMessage(), $e->getCode());
        }
    }

    private function baseUriByCondition(ConditionInterface $condition): string
    {
        return 'https://api.houjin-bangou.nta.go.jp/4/' . $condition . '?'
            . $this->buildQuery($condition->payload());
    }

    private function buildQuery(array $query): string
    {
        return http_build_query(array_merge(['id' => $this->applicationId], $query), '', '&', PHP_QUERY_RFC1738);
    }
}
