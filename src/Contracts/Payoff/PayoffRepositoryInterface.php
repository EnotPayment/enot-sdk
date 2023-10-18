<?php

namespace Enot\Api\Contracts\Payoff;

interface PayoffRepositoryInterface
{
    /**
     * @param string $userId
     * @return array
     */
    public function getUserBalance(string $userId): array;

    /**
     * @param array $requestData
     * @return array
     */
    public function createPayoff(array $requestData): array;

    /**
     * @param array $requestData
     * @return array
     */
    public function getPayoffInfo(array $requestData): array;
}
