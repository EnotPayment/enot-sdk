<?php

namespace Enot\Api\Dto\Request\Payment;

class InvoiceInfoRequestDto
{
    /**
     * @var string
     */
    private string $invoiceId;

    /**
     * @var string|null
     */
    private ?string $orderId;

    /**
     * @param string $invoiceId
     * @param string|null $orderId
     */
    public function __construct(string $invoiceId, ?string $orderId = null)
    {
        $this->invoiceId = $invoiceId;
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getInvoiceId(): string
    {
        return $this->invoiceId;
    }

    /**
     * @return string|null
     */
    public function getOrderId(): ?string
    {
        return $this->orderId;
    }
}
