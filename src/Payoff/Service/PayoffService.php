<?php

namespace Enot\Api\Payoff\Service;

use Enot\Api\Contracts\Client\HttpClientInterface;
use Enot\Api\Contracts\Payoff\PayoffRepositoryInterface;
use Enot\Api\Contracts\Payoff\PayoffServiceInterface;
use Enot\Api\Dto\Request\Payoff\CreatePayoffRequestDto;
use Enot\Api\Dto\Request\Payoff\PayoffInfoRequestDto;
use Enot\Api\Dto\Response\Payoff\CreatePayoffResponseDto;
use Enot\Api\Dto\Response\Payoff\PayoffInfoResponseDto;
use Enot\Api\Dto\Response\Payoff\UserBalanceResponseDto;
use Enot\Api\Exceptions\BaseException;
use Enot\Api\Exceptions\Payoff\PayoffException;
use Enot\Api\Exceptions\Payoff\UserBalanceException;
use Enot\Api\Payoff\Helpers\PayoffHelper;
use Enot\Api\Payoff\Helpers\UserBalanceHelper;
use Enot\Api\Payoff\Repository\PayoffRepository;
use JsonException;

class PayoffService implements PayoffServiceInterface
{
    /**
     * @var PayoffRepositoryInterface|PayoffRepository
     */
    private PayoffRepositoryInterface $payoffRepository;
    /**
     * @var string
     */
    private string $userId;

    /**
     * @param HttpClientInterface $httpClient
     * @param string $userId
     */
    public function __construct(HttpClientInterface $httpClient, string $userId)
    {
        $this->payoffRepository = new PayoffRepository($httpClient);
        $this->userId = $userId;
    }

    /**
     * @throws BaseException
     * @throws UserBalanceException
     * @throws JsonException
     * @return UserBalanceResponseDto
     */
    public function getUserBalance(): UserBalanceResponseDto
    {
        $userBalanceHelper = new UserBalanceHelper();
        $response = $this->payoffRepository->getUserBalance($this->userId);

        return $userBalanceHelper->responseToDto($response);
    }

    /**
     * @throws BaseException
     * @throws PayoffException
     * @throws JsonException
     * @return CreatePayoffResponseDto
     * @param CreatePayoffRequestDto $dto
     */
    public function createPayoff(CreatePayoffRequestDto $dto): CreatePayoffResponseDto
    {
        $payoffHelper = new PayoffHelper();
        $requestData = $payoffHelper->createPayoffDtoToArray($dto, $this->userId);
        $this->clearData($requestData);

        $response = $this->payoffRepository->createPayoff($requestData);

        return $payoffHelper->createPayoffArrayToDto($response);
    }

    /**
     * @throws BaseException
     * @throws PayoffException
     * @throws JsonException
     * @return PayoffInfoResponseDto
     * @param PayoffInfoRequestDto $dto
     */
    public function getPayoffInfo(PayoffInfoRequestDto $dto): PayoffInfoResponseDto
    {
        $payoffHelper = new PayoffHelper();
        $requestData = $payoffHelper->payoffInfoDtoToArray($dto, $this->userId);
        $this->clearData($requestData);

        $response = $this->payoffRepository->getPayoffInfo($requestData);

        return $payoffHelper->payoffInfoArrayToDto($response);
    }

    /**
     * @param $requestData
     * @return void
     */
    private function clearData(&$requestData): void
    {
        foreach ($requestData as $key => $value) {
            if (is_null($value)) {
                unset($requestData[$key]);
            }
        }
    }
}
