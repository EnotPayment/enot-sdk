<?php

namespace Enot\Api\Contracts\Payment;

interface PaymentRepositoryInterface
{
    /**
     * @param string $shopId
     * @return array
     */
    public function getPaymentTariffs(string $shopId): array;

    /**
     * @param array $requestData
     * @return array
     */
    public function createInvoice(array $requestData): array;

    /**
     * @param array $requestData
     * @return array
     */
    public function getInvoiceInfo(array $requestData): array;
}
