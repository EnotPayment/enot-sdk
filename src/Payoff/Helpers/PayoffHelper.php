<?php

namespace Enot\Api\Payoff\Helpers;

use Enot\Api\Contracts\Payoff\PayoffHelperInterface;
use Enot\Api\Dto\Request\Payoff\CreatePayoffRequestDto;
use Enot\Api\Dto\Request\Payoff\PayoffInfoRequestDto;
use Enot\Api\Dto\Response\Payoff\CreatePayoffResponseDto;
use Enot\Api\Dto\Response\Payoff\PayoffInfoResponseDto;
use Enot\Api\Exceptions\BaseException;

class PayoffHelper implements PayoffHelperInterface
{
    /**
     * @param CreatePayoffRequestDto $dto
     * @param string $userId
     * @return array
     */
    public function createPayoffDtoToArray(CreatePayoffRequestDto $dto, string $userId):array
    {
        return [
            'user_id' => $userId,
            'service' => $dto->getService(),
            'wallet_to' => $dto->getWalletTo(),
            'amount' => $dto->getAmount(),
            'order_id' => $dto->getOrderId(),
            'comment' => $dto->getComment(),
            'hook_url' => $dto->getHookUrl(),
            'subtract' => $dto->getSubtract()
        ];
    }

    /**
     * @throws BaseException
     * @return CreatePayoffResponseDto
     * @param array $response
     */
    public function createPayoffArrayToDto(array $response): CreatePayoffResponseDto
    {
        if (empty($data = $response['data'])) {
            throw new BaseException('Empty response data');
        }

        return new CreatePayoffResponseDto(
            $data['payoff_id'],
            $data['amount_withdraw_rub'],
            $data['balance']
        );
    }

    /**
     * @param PayoffInfoRequestDto $dto
     * @param string $userId
     * @return array
     */
    public function payoffInfoDtoToArray(PayoffInfoRequestDto $dto, string $userId): array
    {
        return [
            'user_id' => $userId,
            'id' => $dto->getId(),
            'order_id' => $dto->getOrderId()
        ];
    }

    /**
     * @throws BaseException
     * @return PayoffInfoResponseDto
     * @param array $response
     */
    public function payoffInfoArrayToDto(array $response): PayoffInfoResponseDto
    {
        if (empty($data = $response['data'])) {
            throw new BaseException('Empty response data');
        }

        return new PayoffInfoResponseDto(
            $data['payoff_id'],
            $data['status'],
            $data['order_id'],
            $data['service'],
            $data['wallet'],
            $data['type'],
            $data['subtract'],
            $data['amount'],
            $data['amount_withdraw_rub'],
            $data['commission_rub'],
            $data['receive_currency'],
            $data['amount_receive'],
            $data['comment'],
            $data['created_at'],
            $data['paid_at'],
            $data['error_message']
        );
    }
}
