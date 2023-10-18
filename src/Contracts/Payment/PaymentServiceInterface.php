<?php

namespace Enot\Api\Contracts\Payment;

use Enot\Api\Dto\Request\Payment\InvoiceCreateRequestDto;
use Enot\Api\Dto\Request\Payment\InvoiceInfoRequestDto;
use Enot\Api\Dto\Response\Payment\InvoiceCreateResponseDto;
use Enot\Api\Dto\Response\Payment\InvoiceInfoResponseDto;
use Enot\Api\Dto\Response\Payment\PaymentAvailableTariffsDto;

interface PaymentServiceInterface
{
    /**
     * @return PaymentAvailableTariffsDto
     */
    public function getAvailablePaymentTariffs(): PaymentAvailableTariffsDto;

    /**
     * @param InvoiceCreateRequestDto $dto
     * @return InvoiceCreateResponseDto
     */
    public function createInvoice(InvoiceCreateRequestDto $dto): InvoiceCreateResponseDto;

    /**
     * @param InvoiceInfoRequestDto $dto
     * @return InvoiceInfoResponseDto
     */
    public function getInvoiceInfo(InvoiceInfoRequestDto $dto): InvoiceInfoResponseDto;
}
