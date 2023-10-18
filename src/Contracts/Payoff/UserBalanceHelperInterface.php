<?php

namespace Enot\Api\Contracts\Payoff;

use Enot\Api\Dto\Response\Payoff\UserBalanceResponseDto;

interface UserBalanceHelperInterface
{
    /**
     * @param array $response
     * @return UserBalanceResponseDto
     */
    public function responseToDto(array $response): UserBalanceResponseDto;
}
