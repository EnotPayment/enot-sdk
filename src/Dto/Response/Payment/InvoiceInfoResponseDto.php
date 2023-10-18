<?php

namespace Enot\Api\Dto\Response\Payment;

class InvoiceInfoResponseDto
{
    /**
     * @var string
     */
    private string $invoiceId;

    /**
     * @var string
     */
    private string $orderId;

    /**
     * @var string
     */
    private string $shopId;

    /**
     * @var string
     */
    private string $status;

    /**
     * @var float
     */
    private float $invoiceAmount;

    /**
     * @var float|null
     */
    private ?float $credited;

    /**
     * @var string
     */
    private string $currency;

    /**
     * @var string|null
     */
    private ?string $payService;

    /**
     * @var string|null
     */
    private ?string $payerDetails;

    /**
     * @var float|null
     */
    private ?float $commissionAmount;

    /**
     * @var float|null
     */
    private ?float $commissionPercent;

    /**
     * @var float|null
     */
    private ?float $shopCommissionAmount;

    /**
     * @var float|null
     */
    private ?float $userCommissionAmount;

    /**
     * @var float|null
     */
    private ?float $userCommissionPercent;

    /**
     * @var array|null
     */
    private ?array $customField;

    /**
     * @var string
     */
    private string $createdAt;

    /**
     * @var string
     */
    private string $expiredAt;

    /**
     * @var string|null
     */
    private ?string $paidAt;

    /**
     * @param string $invoiceId
     * @param string $orderId
     * @param string $shopId
     * @param string $status
     * @param float $invoiceAmount
     * @param float|null $credited
     * @param string $currency
     * @param string|null $payService
     * @param string|null $payerDetails
     * @param float|null $commissionAmount
     * @param float|null $commissionPercent
     * @param float|null $shopCommissionAmount
     * @param float|null $userCommissionAmount
     * @param float|null $userCommissionPercent
     * @param array|null $customField
     * @param string $createdAt
     * @param string $expiredAt
     * @param string|null $paidAt
     */
    public function __construct(
        string $invoiceId,
        string $orderId,
        string $shopId,
        string $status,
        float $invoiceAmount,
        ?float $credited,
        string $currency,
        ?string $payService,
        ?string $payerDetails,
        ?float $commissionAmount,
        ?float $commissionPercent,
        ?float $shopCommissionAmount,
        ?float $userCommissionAmount,
        ?float $userCommissionPercent,
        ?array $customField,
        string $createdAt,
        string $expiredAt,
        ?string $paidAt
    )
    {
        $this->invoiceId = $invoiceId;
        $this->orderId = $orderId;
        $this->shopId = $shopId;
        $this->status = $status;
        $this->invoiceAmount = $invoiceAmount;
        $this->credited = $credited;
        $this->currency = $currency;
        $this->payService = $payService;
        $this->payerDetails = $payerDetails;
        $this->commissionAmount = $commissionAmount;
        $this->commissionPercent = $commissionPercent;
        $this->shopCommissionAmount = $shopCommissionAmount;
        $this->userCommissionAmount = $userCommissionAmount;
        $this->userCommissionPercent = $userCommissionPercent;
        $this->customField = $customField;
        $this->createdAt = $createdAt;
        $this->expiredAt = $expiredAt;
        $this->paidAt = $paidAt;
    }

    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getShopId(): string
    {
        return $this->shopId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getInvoiceAmount(): float
    {
        return $this->invoiceAmount;
    }

    public function getCredited(): ?float
    {
        return $this->credited;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getPayService(): ?string
    {
        return $this->payService;
    }

    public function getPayerDetails(): ?string
    {
        return $this->payerDetails;
    }

    public function getCommissionAmount(): ?float
    {
        return $this->commissionAmount;
    }

    public function getCommissionPercent(): ?float
    {
        return $this->commissionPercent;
    }

    public function getShopCommissionAmount(): ?float
    {
        return $this->shopCommissionAmount;
    }

    public function getUserCommissionAmount(): ?float
    {
        return $this->userCommissionAmount;
    }

    public function getUserCommissionPercent(): ?float
    {
        return $this->userCommissionPercent;
    }

    public function getCustomField(): array
    {
        return $this->customField;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getExpiredAt(): string
    {
        return $this->expiredAt;
    }

    public function getPaidAt(): ?string
    {
        return $this->paidAt;
    }
}
