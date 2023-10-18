<?php

namespace Enot\Api\Dto\Response\Payoff;

class CreatePayoffResponseDto
{
    /**
     * @var string
     */
    private string $payoffId;

    /**
     * @var string
     */
    private string $amountWithdrawRub;

    /**
     * @var string
     */
    private string $balance;

    /**
     * @param string $payoffId
     * @param string $amountWithdrawRub
     * @param string $balance
     */
    public function __construct(string $payoffId, string $amountWithdrawRub, string $balance)
    {
        $this->payoffId = $payoffId;
        $this->amountWithdrawRub = $amountWithdrawRub;
        $this->balance = $balance;
    }

    /**
     * @return string
     */
    public function getPayoffId(): string
    {
        return $this->payoffId;
    }

    /**
     * @return string
     */
    public function getAmountWithdrawRub(): string
    {
        return $this->amountWithdrawRub;
    }

    /**
     * @return string
     */
    public function getBalance(): string
    {
        return $this->balance;
    }
}
