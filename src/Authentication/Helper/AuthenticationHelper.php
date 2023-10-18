<?php

namespace Enot\Api\Authentication\Helper;

use Enot\Api\Contracts\Authentication\AuthenticationHelperInterface;
use Enot\Api\Contracts\Client\HttpClientInterface;
use Enot\Api\Http\Client\HttpClient;

class AuthenticationHelper implements AuthenticationHelperInterface
{
    /**
     * @param string $secretKey
     * @return HttpClientInterface
     */
    public function paymentAuthentication(string $secretKey): HttpClientInterface
    {
        $headerParams = ["x-api-key: $secretKey"];
        return new HttpClient($headerParams);
    }

    /**
     * @param string $secretKey
     * @return HttpClientInterface
     */
    public function payoffAuthentication(string $secretKey): HttpClientInterface
    {
        $headerParams = ["x-api-signature-sha256: $secretKey"];
        return new HttpClient($headerParams);
    }
}
