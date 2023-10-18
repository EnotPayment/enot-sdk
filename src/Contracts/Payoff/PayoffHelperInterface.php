<?php

namespace Enot\Api\Contracts\Payoff;

use Enot\Api\Dto\Request\Payoff\CreatePayoffRequestDto;
use Enot\Api\Dto\Request\Payoff\PayoffInfoRequestDto;
use Enot\Api\Dto\Response\Payoff\CreatePayoffResponseDto;
use Enot\Api\Dto\Response\Payoff\PayoffInfoResponseDto;

interface PayoffHelperInterface
{
    /**
     * @param CreatePayoffRequestDto $dto
     * @param string $userId
     * @return array
     */
    public function createPayoffDtoToArray(CreatePayoffRequestDto $dto, string $userId):array;

    /**
     * @param array $response
     * @return CreatePayoffResponseDto
     */
    public function createPayoffArrayToDto(array $response): CreatePayoffResponseDto;

    /**
     * @param PayoffInfoRequestDto $dto
     * @param string $userId
     * @return array
     */
    public function payoffInfoDtoToArray(PayoffInfoRequestDto $dto, string $userId): array;

    /**
     * @param array $response
     * @return PayoffInfoResponseDto
     */
    public function payoffInfoArrayToDto(array $response): PayoffInfoResponseDto;
}
