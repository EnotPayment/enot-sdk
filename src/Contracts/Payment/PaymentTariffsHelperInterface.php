<?php

namespace Enot\Api\Contracts\Payment;

use Enot\Api\Dto\Response\Payment\PaymentAvailableTariffsDto;
use Enot\Api\Dto\Response\Payment\PaymentTariffParamsResponseDto;

interface PaymentTariffsHelperInterface
{
    /**
     * @param array $data
     * @return PaymentAvailableTariffsDto
     */
    public function getTariffsFromResponse(array $data): PaymentAvailableTariffsDto;

    /**
     * @param array $tariffParams
     * @return PaymentTariffParamsResponseDto
     */
    public function responseToDto(array $tariffParams): PaymentTariffParamsResponseDto;
}
