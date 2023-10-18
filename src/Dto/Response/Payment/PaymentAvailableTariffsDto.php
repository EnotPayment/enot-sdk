<?php

namespace Enot\Api\Dto\Response\Payment;

class PaymentAvailableTariffsDto
{
    /**
     * @var PaymentTariffParamsResponseDto[]
     */
    private array $tariffs;

    /**
     * @param PaymentTariffParamsResponseDto[] $tariffs
     */
    public function __construct(array $tariffs)
    {
        $this->tariffs = $tariffs;
    }

    /**
     * @return PaymentTariffParamsResponseDto[]
     */
    public function getTariffs(): array
    {
        return $this->tariffs;
    }
}
