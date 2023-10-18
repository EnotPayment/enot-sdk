<?php

namespace Test\Enot\Api\Mocks;

use Enot\Api\Contracts\Payoff\PayoffServiceInterface;
use Enot\Api\Dto\Request\Payoff\CreatePayoffRequestDto;
use Enot\Api\Dto\Response\Payoff\CreatePayoffResponseDto;
use Enot\Api\Dto\Response\Payoff\PayoffInfoResponseDto;
use Enot\Api\Dto\Response\Payoff\UserBalanceResponseDto;
use Enot\Api\Dto\Request\Payoff\PayoffInfoRequestDto;

class PayoffServiceSuccessMock implements PayoffServiceInterface
{
    /**
     * @return UserBalanceResponseDto
     */
    public function getUserBalance(): UserBalanceResponseDto
    {
        return new UserBalanceResponseDto(
            618097.2,
            618087.2,
            10
        );
    }

    /**
     * @param CreatePayoffRequestDto $dto
     * @return CreatePayoffResponseDto
     */
    public function createPayoff(CreatePayoffRequestDto $dto): CreatePayoffResponseDto
    {
        return new CreatePayoffResponseDto(
            '3fa85f64-5717-4562-b3fc-2c963f66afa6',
            0,
            0
        );
    }

    /**
     * @param PayoffInfoRequestDto $dto
     * @return PayoffInfoResponseDto
     */
    public function getPayoffInfo(PayoffInfoRequestDto $dto): PayoffInfoResponseDto
    {
        return new PayoffInfoResponseDto(
            'a4346bd4-dbc4-42f4-acd3-de5f179eecba',
            'wait',
            'string',
            'card',
            '2200700401643761',
            'api',
            'amount',
            100,
            20,
            3,
            'RUB',
            80.00,
            null,
            '2023-10-10 10:30'
        );
    }
}
