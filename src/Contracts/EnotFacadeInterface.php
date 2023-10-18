<?php

namespace Enot\Api\Contracts;

use Enot\Api\Dto\Request\Payment\InvoiceCreateRequestDto;
use Enot\Api\Dto\Request\Payment\InvoiceInfoRequestDto;
use Enot\Api\Dto\Request\Payoff\CreatePayoffRequestDto;
use Enot\Api\Dto\Request\Payoff\PayoffInfoRequestDto;
use Enot\Api\Dto\Response\Payment\InvoiceCreateResponseDto;
use Enot\Api\Dto\Response\Payment\InvoiceInfoResponseDto;
use Enot\Api\Dto\Response\Payment\PaymentAvailableTariffsDto;
use Enot\Api\Dto\Response\Payoff\CreatePayoffResponseDto;
use Enot\Api\Dto\Response\Payoff\PayoffInfoResponseDto;
use Enot\Api\Dto\Response\Payoff\UserBalanceResponseDto;

interface EnotFacadeInterface
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

    /**
     * @param string $webhookRequest
     * @param string $signature
     * @return bool
     */
    public function checkPaymentWebhookSignature(string $webhookRequest, string $signature): bool;

    /**
     * @return UserBalanceResponseDto
     */
    public function getUserBalance(): UserBalanceResponseDto;

    /**
     * @param CreatePayoffRequestDto $dto
     * @return CreatePayoffResponseDto
     */
    public function createPayoff(CreatePayoffRequestDto $dto): CreatePayoffResponseDto;

    /**
     * @param PayoffInfoRequestDto $dto
     * @return PayoffInfoResponseDto
     */
    public function getPayoffInfo(PayoffInfoRequestDto $dto): PayoffInfoResponseDto;

    /**
     * @param string $webhookRequest
     * @param string $signature
     * @return bool
     */
    public function checkPayoffWebhookSignature(string $webhookRequest, string $signature): bool;
}
