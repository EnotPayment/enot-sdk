<?php

namespace Enot\Api\Dto\Response\Payoff;

class UserBalanceResponseDto
{
    /**
     * @var float
     */
    private float $balance;

    /**
     * @var float
     */
    private float $activeBalance;

    /**
     * @var float
     */
    private float $freezeBalance;

    /**
     * @param float $balance
     * @param float $activeBalance
     * @param float $freezeBalance
     */
    public function __construct(float $balance, float $activeBalance, float $freezeBalance)
    {
        $this->balance = $balance;
        $this->activeBalance = $activeBalance;
        $this->freezeBalance = $freezeBalance;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @return float
     */
    public function getActiveBalance(): float
    {
        return $this->activeBalance;
    }

    /**
     * @return float
     */
    public function getFreezeBalance(): float
    {
        return $this->freezeBalance;
    }
}
