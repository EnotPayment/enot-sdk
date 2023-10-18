<?php

namespace Enot\Api\Dto\Response\Payment;

class InvoiceCreateResponseDto
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $amount;

    /**
     * @var string
     */
    private string $currency;

    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $expired;

    /**
     * @param string $id
     * @param string $amount
     * @param string $currency
     * @param string $url
     * @param string $expired
     */
    public function __construct(string $id, string $amount, string $currency, string $url, string $expired)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->url = $url;
        $this->expired = $expired;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getExpired(): string
    {
        return $this->expired;
    }
}
