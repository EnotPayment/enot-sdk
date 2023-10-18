<?php

namespace Enot\Api\Contracts\Authentication;

use Enot\Api\Contracts\Client\HttpClientInterface;

interface AuthenticationHelperInterface
{
    /**
     * @param string $secretKey
     * @return HttpClientInterface
     */
    public function paymentAuthentication(string $secretKey): HttpClientInterface;

    /**
     * @param string $secretKey
     * @return HttpClientInterface
     */
    public function payoffAuthentication(string $secretKey): HttpClientInterface;
}
