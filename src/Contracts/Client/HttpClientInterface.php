<?php

namespace Enot\Api\Contracts\Client;

interface HttpClientInterface
{
    /**
     * @param string $apiMethod
     * @param array|null $requestParams
     * @param string|null $requestType
     * @param int|null $timeout
     * @return array
     */
    // public function request(string $apiMethod, ?array $requestParams = null, ?string $requestType = 'GET', ?int $timeout = 5): array;
}
