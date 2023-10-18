<?php

namespace Test\Enot\Api\Mocks;

use Enot\Api\Contracts\Payment\PaymentServiceInterface;
use Enot\Api\Dto\Request\Payment\InvoiceCreateRequestDto;
use Enot\Api\Dto\Request\Payment\InvoiceInfoRequestDto;
use Enot\Api\Dto\Response\Payment\InvoiceCreateResponseDto;
use Enot\Api\Dto\Response\Payment\InvoiceInfoResponseDto;
use Enot\Api\Dto\Response\Payment\PaymentAvailableTariffsDto;
use Enot\Api\Exceptions\Payment\InvoiceException;
use Enot\Api\Exceptions\Payment\PaymentException;

class PaymentServiceFailMock implements PaymentServiceInterface
{
    /**
     * @throws PaymentException
     * @return PaymentAvailableTariffsDto
     */
    public function getAvailablePaymentTariffs(): PaymentAvailableTariffsDto
    {
        $response = [
            "data" => null,
            "error" => 'Внутренняя ошибка системы, попробуйте позже',
            "status" => 500,
            "status_check" => false
        ];

        throw new PaymentException($response['error'], $response['status']);
    }

    /**
     * @throws InvoiceException
     * @return InvoiceCreateResponseDto
     * @param InvoiceCreateRequestDto $dto
     */
    public function createInvoice(InvoiceCreateRequestDto $dto): InvoiceCreateResponseDto
    {
        $response = [
            'data' => null,
            'error' => 'Номер заказа должен быть уникальным',
            'status' => 422,
            'status_check' => false
        ];

        throw new InvoiceException($response['error'], $response['status']);
    }

    /**
     * @throws InvoiceException
     * @return InvoiceInfoResponseDto
     * @param InvoiceInfoRequestDto $dto
     */
    public function getInvoiceInfo(InvoiceInfoRequestDto $dto): InvoiceInfoResponseDto
    {
        $response = [
            'data' => null,
            'error' => 'Инвойс не найден',
            'status' => 404,
            'status_check' => false
        ];

        throw new InvoiceException($response['error'], $response['status']);
    }
}
