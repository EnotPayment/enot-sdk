<?php

namespace Enot\Api\Dto\Response\Payoff;

class PayoffInfoResponseDto
{
    /**
     * @var string
     */
    private string $payoffId;

    /**
     * @var string
     */
    private string $status;

    /**
     * @var string
     */
    private string $orderId;

    /**
     * @var string
     */
    private string $service;

    /**
     * @var string|null
     */
    private ?string $wallet;

    /**
     * @var string
     */
    private string $type;

    /**
     * @var string
     */
    private string $subtract;

    /**
     * @var float
     */
    private float $amount;

    /**
     * @var float
     */
    private float $amountWithdrawRub;

    /**
     * @var float
     */
    private float $commissionRub;

    /**
     * @var string
     */
    private string $receiveCurrency;

    /**
     * @var string
     */
    private string $amountReceive;

    /**
     * @var string|null
     */
    private ?string $comment;

    /**
     * @var string
     */
    private string $createdAt;

    /**
     * @var string|null
     */
    private ?string $paidAt;

    /**
     * @var string|null
     */
    private ?string $errorMessage;

    /**
     * @param string $payoffId
     * @param string $status
     * @param string $orderId
     * @param string $service
     * @param string|null $wallet
     * @param string $type
     * @param string $subtract
     * @param float $amount
     * @param float $amountWithdrawRub
     * @param float $commissionRub
     * @param string $receiveCurrency
     * @param string $amountReceive
     * @param string|null $comment
     * @param string $createdAt
     * @param string|null $paidAt
     * @param string|null $errorMessage
     */
    public function __construct(
        string $payoffId,
        string $status,
        string $orderId,
        string $service,
        ?string $wallet,
        string $type,
        string $subtract,
        float $amount,
        float $amountWithdrawRub,
        float $commissionRub,
        string $receiveCurrency,
        string $amountReceive,
        ?string $comment,
        string $createdAt,
        ?string $paidAt = null,
        ?string $errorMessage = null
    )
    {
        $this->payoffId = $payoffId;
        $this->status = $status;
        $this->orderId = $orderId;
        $this->service = $service;
        $this->wallet = $wallet;
        $this->type = $type;
        $this->subtract = $subtract;
        $this->amount = $amount;
        $this->amountWithdrawRub = $amountWithdrawRub;
        $this->commissionRub = $commissionRub;
        $this->receiveCurrency = $receiveCurrency;
        $this->amountReceive = $amountReceive;
        $this->comment = $comment;
        $this->createdAt = $createdAt;
        $this->paidAt = $paidAt;
        $this->errorMessage = $errorMessage;
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
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @return string|null
     */
    public function getWallet(): ?string
    {
        return $this->wallet;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getSubtract(): string
    {
        return $this->subtract;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getAmountWithdrawRub(): float
    {
        return $this->amountWithdrawRub;
    }

    /**
     * @return float
     */
    public function getCommissionRub(): float
    {
        return $this->commissionRub;
    }

    /**
     * @return string
     */
    public function getReceiveCurrency(): string
    {
        return $this->receiveCurrency;
    }

    /**
     * @return string
     */
    public function getAmountReceive(): string
    {
        return $this->amountReceive;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string|null
     */
    public function getPaidAt(): ?string
    {
        return $this->paidAt;
    }

    /**
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
}
