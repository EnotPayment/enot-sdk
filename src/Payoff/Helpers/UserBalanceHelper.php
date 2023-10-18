<?php

namespace Enot\Api\Payoff\Helpers;

use Enot\Api\Contracts\Payoff\UserBalanceHelperInterface;
use Enot\Api\Dto\Response\Payoff\UserBalanceResponseDto;
use Enot\Api\Exceptions\BaseException;

class UserBalanceHelper implements UserBalanceHelperInterface
{
    /**
     * @throws BaseException
     * @return UserBalanceResponseDto
     * @param array $response
     */
    public function responseToDto(array $response): UserBalanceResponseDto
    {
        if (empty($data = $response['data'])) {
            throw new BaseException('Empty response data');
        }

        return new UserBalanceResponseDto(
            $data['balance'],
            $data['active_balance'],
            $data['freeze_balance']
        );
    }
}
