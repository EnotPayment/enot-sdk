<?php

namespace Test\Enot\Api\Mocks;

use Enot\Api\Contracts\Payment\PaymentServiceInterface;
use Enot\Api\Dto\Request\Payment\InvoiceInfoRequestDto;
use Enot\Api\Dto\Response\Payment\InvoiceCreateResponseDto;
use Enot\Api\Dto\Response\Payment\InvoiceInfoResponseDto;
use Enot\Api\Dto\Response\Payment\PaymentAvailableTariffsDto;
use Enot\Api\Dto\Response\Payment\PaymentTariffParamsResponseDto;
use Enot\Api\Dto\Request\Payment\InvoiceCreateRequestDto;

class PaymentServiceSuccessMock implements PaymentServiceInterface
{
    /**
     * @return PaymentAvailableTariffsDto
     */
    public function getAvailablePaymentTariffs(): PaymentAvailableTariffsDto
    {
        $tariffArray = [new PaymentTariffParamsResponseDto(
            10,
            2,
            null,
            1000,
            3,
            3,
            'card',
            "Банковская карта",
            "RUB",
            'success'
        )];

        return new PaymentAvailableTariffsDto($tariffArray);
    }

    /**
     * @param InvoiceCreateRequestDto $dto
     * @return InvoiceCreateResponseDto
     */
    public function createInvoice(InvoiceCreateRequestDto $dto): InvoiceCreateResponseDto
    {
        return new InvoiceCreateResponseDto(
            "3fa85f64-5717-4562-b3fc-2c963f66afa6",
            0,
            "USD",
            "https://enot.io/pay/a6eee926-2679-741b-77a2-15789a3aa6cf",
            "2023-12-31 20:20:20"
        );
    }

    /**
     * @param InvoiceInfoRequestDto $dto
     * @return InvoiceInfoResponseDto
     */
    public function getInvoiceInfo(InvoiceInfoRequestDto $dto): InvoiceInfoResponseDto
    {
        return new InvoiceInfoResponseDto(
            "3fa85f64-5717-4562-b3fc-2c963f66afa6",
            "123",
            "3fa85f64-5717-4562-b3fc-2c963f66afa6",
            "created",
            0,
            0,
            "RUB",
            "card",
            0,
            0,
            0,
            0,
            0,
            0,
            [
                "paymentId" => '123'
            ],
            "2017-07-21 10:00",
            "2017-07-21 10:00",
            "2017-07-21 10:00"
        );
    }
}
