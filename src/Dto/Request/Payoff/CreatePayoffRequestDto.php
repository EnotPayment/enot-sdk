<?php

namespace Enot\Api\Dto\Request\Payoff;

class CreatePayoffRequestDto
{
    /**
     * @var string
     */
    private string $service;

    /**
     * @var string
     */
    private string $walletTo;

    /**
     * @var float
     */
    private float $amount;

    /**
     * @var string|null
     */
    private string $orderId;

    /**
     * @var string|null
     */
    private ?string $comment;

    /**
     * @var string|null
     */
    private ?string $hookUrl;

    /**
     * @var int|null
     */
    private ?int $subtract;

    /**
     * @param string $service
     * @param string $walletTo
     * @param float $amount
     * @param string|null $orderId
     * @param string|null $comment
     * @param string|null $hookUrl
     * @param int|null $subtract
     */
    public function __construct(
        string $service,
        string $walletTo,
        float $amount,
        string $orderId,
        ?string $comment = null,
        ?string $hookUrl = null,
        ?int $subtract = 2
    )
    {
        $this->service = $service;
        $this->walletTo = $walletTo;
        $this->amount = $amount;
        $this->orderId = $orderId;
        $this->comment = $comment;
        $this->hookUrl = $hookUrl;
        $this->subtract = $subtract;
    }

    /**
     * @return string
     */
    public function getService(): string
    {
        return $this->service;
    }

    /**
     * @return string
     */
    public function getWalletTo(): string
    {
        return $this->walletTo;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getOrderId(): string
    {
        return $this->orderId;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * @return string|null
     */
    public function getHookUrl(): ?string
    {
        return $this->hookUrl;
    }

    /**
     * @return int|null
     */
    public function getSubtract(): ?int
    {
        return $this->subtract;
    }
}
