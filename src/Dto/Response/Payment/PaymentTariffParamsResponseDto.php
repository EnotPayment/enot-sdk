<?php

namespace Enot\Api\Dto\Response\Payment;

class PaymentTariffParamsResponseDto
{
    /**
     * @var int
     */
    private int $percent;

    /**
     * @var int
     */
    private int $fix;

    /**
     * @var int|null
     */
    private ?int $minSum;

    /**
     * @var int|null
     */
    private ?int $maxSum;

    /**
     * @var int|null
     */
    private ?int $shopPercent;

    /**
     * @var int|null
     */
    private ?int $userPercent;

    /**
     * @var string
     */
    private string $service;

    /**
     * @var string|null
     */
    private ?string $serviceLabel;

    /**
     * @var string
     */
    private string $currency;

    /**
     * @var string
     */
    private string $status;

    /**
     * @param int $percent
     * @param int $fix
     * @param int|null $minSum
     * @param int|null $maxSum
     * @param int|null $shopPercent
     * @param int|null $userPercent
     * @param string $service
     * @param string|null $serviceLabel
     * @param string $currency
     * @param string $status
     */
    public function __construct
    (
        int    $percent,
        int    $fix,
        ?int    $minSum,
        ?int    $maxSum,
        ?int    $shopPercent,
        ?int    $userPercent,
        string  $service,
        ?string $serviceLabel,
        string  $currency,
        string $status
    )
    {
        $this->percent = $percent;
        $this->fix = $fix;
        $this->minSum = $minSum;
        $this->maxSum = $maxSum;
        $this->shopPercent = $shopPercent;
        $this->userPercent = $userPercent;
        $this->service = $service;
        $this->serviceLabel = $serviceLabel;
        $this->currency = $currency;
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getPercent(): ?int
    {
        return $this->percent;
    }

    /**
     * @return int|null
     */
    public function getFix(): ?int
    {
        return $this->fix;
    }

    /**
     * @return int|null
     */
    public function getMinSum(): ?int
    {
        return $this->minSum;
    }

    /**
     * @return int|null
     */
    public function getMaxSum(): ?int
    {
        return $this->maxSum;
    }

    /**
     * @return int|null
     */
    public function getShopPercent(): ?int
    {
        return $this->shopPercent;
    }

    /**
     * @return int|null
     */
    public function getUserPercent(): ?int
    {
        return $this->userPercent;
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
    public function getServiceLabel(): ?string
    {
        return $this->serviceLabel;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }
}
