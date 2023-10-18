<?php

namespace Enot\Api\Contracts\Payoff;

use Enot\Api\Dto\Request\Payoff\CreatePayoffRequestDto;
use Enot\Api\Dto\Request\Payoff\PayoffInfoRequestDto;
use Enot\Api\Dto\Response\Payoff\CreatePayoffResponseDto;
use Enot\Api\Dto\Response\Payoff\PayoffInfoResponseDto;
use Enot\Api\Dto\Response\Payoff\UserBalanceResponseDto;

interface PayoffServiceInterface
{
    /**
     * @return UserBalanceResponseDto
     */
    public function getUserBalance(): UserBalanceResponseDto;

    /**
     * @param CreatePayoffRequestDto $dto
     * @return CreatePayoffResponseDto
     */
    public function createPayoff(CreatePayoffRequestDto $dto): CreatePayoffResponseDto;

    /**
     * @param PayoffInfoRequestDto $dto
     * @return PayoffInfoResponseDto
     */
    public function getPayoffInfo(PayoffInfoRequestDto $dto): PayoffInfoResponseDto;
}
