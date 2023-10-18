<?php

namespace Enot\Api\Payment\Helpers;

use Enot\Api\Contracts\Payment\PaymentTariffsHelperInterface;
use Enot\Api\Dto\Response\Payment\PaymentAvailableTariffsDto;
use Enot\Api\Dto\Response\Payment\PaymentTariffParamsResponseDto;
use Enot\Api\Exceptions\BaseException;

class PaymentTariffsHelper implements PaymentTariffsHelperInterface
{
    /**
     * @throws BaseException
     * @return PaymentAvailableTariffsDto
     * @param array $data
     */
    public function getTariffsFromResponse(array $data): PaymentAvailableTariffsDto
    {
        if (empty($data['data'])) {
            throw new BaseException('Empty response data');
        } elseif (empty($data['data']['tariffs'])) {
            throw new BaseException('Empty response tariffs data');
        }

        $tariffsArray = [];

        foreach ($data['data']['tariffs'] as $tariffParams) {
            $tariffsArray[] = $this->responseToDto($tariffParams);
        }

        return new PaymentAvailableTariffsDto($tariffsArray);
    }

    /**
     * @param array $tariffParams
     * @return PaymentTariffParamsResponseDto
     */
    public function responseToDto(array $tariffParams): PaymentTariffParamsResponseDto
    {
        return new PaymentTariffParamsResponseDto(
            $tariffParams['percent'],
            $tariffParams['fix'],
            $tariffParams['minSum'],
            $tariffParams['maxSum'],
            $tariffParams['shopPercent'],
            $tariffParams['userPercent'],
            $tariffParams['service'],
            $tariffParams['serviceLabel'],
            $tariffParams['currency'],
            $tariffParams['status']
        );
    }
}
