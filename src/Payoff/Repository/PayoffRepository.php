<?php

namespace Enot\Api\Payoff\Repository;

use Enot\Api\Constants\HttpClient\HttpClientConstants;
use Enot\Api\Constants\Payoff\PayoffConstants;
use Enot\Api\Contracts\Client\HttpClientInterface;
use Enot\Api\Contracts\Payoff\PayoffRepositoryInterface;
use Enot\Api\Exceptions\Payoff\PayoffException;
use Enot\Api\Exceptions\Payoff\UserBalanceException;
use JsonException;

class PayoffRepository implements PayoffRepositoryInterface
{
    /**
     * @var HttpClientInterface
     */
    private HttpClientInterface $httpClient;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @throws UserBalanceException
     * @throws JsonException
     * @param string $userId
     * @return array
     */
    public function getUserBalance(string $userId): array
    {
        $method = sprintf(PayoffConstants::USER_BALANCE_METHOD, $userId);

        $response = $this->httpClient->request($method);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new UserBalanceException(
                is_array($response['error']) ?
                    json_encode($response['error'], JSON_THROW_ON_ERROR) :
                    $response['error'], $response['status']
            );
        }

        return $response;
    }

    /**
     * @throws PayoffException
     * @throws JsonException
     * @param array $requestData
     * @return array
     */
    public function createPayoff(array $requestData): array
    {
        $response = $this->httpClient->request(
            PayoffConstants::PAYOFF_CREATE_METHOD,
            $requestData,
            HttpClientConstants::POST_REQUEST
        );

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new PayoffException(
                is_array($response['error']) ?
                    json_encode($response['error'], JSON_THROW_ON_ERROR) :
                    $response['error'], $response['status']
            );
        }

        return $response;
    }

    /**
     * @throws PayoffException
     * @throws JsonException
     * @param array $requestData
     * @return array
     */
    public function getPayoffInfo(array $requestData): array
    {
        $response = $this->httpClient->request(PayoffConstants::PAYOFF_INFO_METHOD, $requestData);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new PayoffException(
                is_array($response['error']) ?
                    json_encode($response['error'], JSON_THROW_ON_ERROR) :
                    $response['error'], $response['status']
            );
        }

        return $response;
    }
}
