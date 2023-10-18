<?php

namespace Enot\Api\Dto\Request\Payment;

class InvoiceCreateRequestDto
{
    /**
     * @var float
     */
    private float $amount;

    /**
     * @var string
     */
    private string $orderId;

    /**
     * @var string|null
     */
    private ?string $currency;

    /**
     * @var string|null
     */
    private ?string $hookUrl;

    /**
     * @var string|null
     */
    private ?string $customFields;

    /**
     * @var string|null
     */
    private ?string $comment;

    /**
     * @var string|null
     */
    private ?string $failUrl;

    /**
     * @var string|null
     */
    private ?string $successUrl;

    /**
     * @var int|null
     */
    private ?int $expire;

    /**
     * @var array|null
     */
    private ?array $includeService;

    /**
     * @var array|null
     */
    private ?array $excludeService;

    /**
     * @param float $amount
     * @param string $orderId
     * @param string|null $currency
     * @param string|null $hookUrl
     * @param string|null $customFields
     * @param string|null $comment
     * @param string|null $failUrl
     * @param string|null $successUrl
     * @param int|null $expire
     * @param array|null $includeService
     * @param array|null $excludeService
     */
    public function __construct(
        float $amount,
        string $orderId,
        ?string $currency = 'RUB',
        ?string $hookUrl = null,
        ?string $customFields = null,
        ?string $comment = null,
        ?string $failUrl = null,
        ?string $successUrl = null,
        ?int $expire = 300,
        ?array $includeService = null,
        ?array $excludeService = null
    ) 
    {
        $this->amount = $amount;
        $this->orderId = $orderId;
        $this->currency = $currency;
        $this->hookUrl = $hookUrl;
        $this->customFields = $customFields;
        $this->comment = $comment;
        $this->failUrl = $failUrl;
        $this->successUrl = $successUrl;
        $this->expire = $expire;
        $this->includeService = $includeService;
        $this->excludeService = $excludeService;
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
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @return string|null
     */
    public function getHookUrl(): ?string
    {
        return $this->hookUrl;
    }

    /**
     * @return string|null
     */
    public function getCustomFields(): ?string
    {
        return $this->customFields;
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
    public function getFailUrl(): ?string
    {
        return $this->failUrl;
    }

    /**
     * @return string|null
     */
    public function getSuccessUrl(): ?string
    {
        return $this->successUrl;
    }

    /**
     * @return int|null
     */
    public function getExpire(): ?int
    {
        return $this->expire;
    }

    /**
     * @return array|null
     */
    public function getIncludeService(): ?array
    {
        return $this->includeService;
    }

    /**
     * @return array|null
     */
    public function getExcludeService(): ?array
    {
        return $this->excludeService;
    }
}
