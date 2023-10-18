<?php

namespace Enot\Api\Http\Client;

use Enot\Api\Constants\HttpClient\HttpClientConstants;
use Enot\Api\Exceptions\BaseException;
use Enot\Api\Contracts\Client\HttpClientInterface;
use JsonException;

class HttpClient implements HttpClientInterface
{
    /**
     * @var array
     */
    private array $headerParams;

    /**
     * @var resource
     */
    private $curl;

    /**
     * @param array|null $headerParams
     */
    public function __construct(?array $headerParams = [])
    {
        $this->curl = curl_init();
        $requiredHeaders = [
            'Accept: application/json',
            'Content-Type: application/json'
        ];

        $this->headerParams = array_merge($requiredHeaders, $headerParams);
    }

    /**
     * @throws BaseException
     * @throws JsonException
     * @param string|null $requestType
     * @param int|null $timeout
     * @return array
     * @param string $apiMethod
     * @param array|null $requestParams
     */
    public function request(string $apiMethod, ?array $requestParams = null, ?string $requestType = 'GET', ?int $timeout = 5): array
    {
        $url = HttpClientConstants::URL . $apiMethod;
        $encodedParams = null;

        if ($requestType === 'GET') {
            $url .= !empty($requestParams) ? '?' . http_build_query($requestParams) : null;
        } else {
            $encodedParams = json_encode($requestParams, JSON_THROW_ON_ERROR);
        }

        $curlOptions = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $requestType,
            CURLOPT_HTTPHEADER => $this->headerParams,
            CURLOPT_POSTFIELDS => $encodedParams,
        ];

        curl_setopt_array($this->curl, $curlOptions);
        $response = curl_exec($this->curl);

        if (!$response) {
            throw new BaseException('Error request');
        }

        return json_decode($response, true, 512, JSON_THROW_ON_ERROR);
    }

    public function __destruct() {
        curl_close($this->curl);
    }
}
