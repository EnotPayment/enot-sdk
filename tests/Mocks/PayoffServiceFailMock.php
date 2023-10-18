<?php

namespace Test\Enot\Api\Mocks;

use Enot\Api\Contracts\Payoff\PayoffServiceInterface;
use Enot\Api\Dto\Request\Payoff\CreatePayoffRequestDto;
use Enot\Api\Dto\Request\Payoff\PayoffInfoRequestDto;
use Enot\Api\Dto\Response\Payoff\CreatePayoffResponseDto;
use Enot\Api\Dto\Response\Payoff\PayoffInfoResponseDto;
use Enot\Api\Dto\Response\Payoff\UserBalanceResponseDto;
use Enot\Api\Exceptions\Payoff\PayoffException;
use Enot\Api\Exceptions\Payoff\UserBalanceException;

class PayoffServiceFailMock implements PayoffServiceInterface
{
    /**
     * @throws UserBalanceException
     * @return UserBalanceResponseDto
     */
    public function getUserBalance(): UserBalanceResponseDto
    {
        $response = [
            "data" => null,
            "error" => 'Поле user id должно быть в формате UUID.',
            "status" => 422,
            "status_check" => false
        ];

        throw new UserBalanceException($response['error'], $response['status']);
    }

    /**
     * @throws PayoffException
     * @return CreatePayoffResponseDto
     * @param CreatePayoffRequestDto $dto
     */
    public function createPayoff(CreatePayoffRequestDto $dto): CreatePayoffResponseDto
    {
        $response = [
            "data" => null,
            "error" => 'Недействительный кошелёк.',
            "status" => 422,
            "status_check" => false
        ];

        throw new PayoffException($response['error'], $response['status']);
    }

    /**
     * @throws PayoffException
     * @return PayoffInfoResponseDto
     * @param PayoffInfoRequestDto $dto
     */
    public function getPayoffInfo(PayoffInfoRequestDto $dto): PayoffInfoResponseDto
    {
        $response = [
            "data" => null,
            "error" => 'Вывод не найден.',
            "status" => 404,
            "status_check" => false
        ];

        throw new PayoffException($response['error'], $response['status']);
    }
}
