<?php

namespace Enot\Api\Payment\Helpers;

use Enot\Api\Contracts\Payment\InvoiceHelperInterface;
use Enot\Api\Dto\Request\Payment\InvoiceCreateRequestDto;
use Enot\Api\Dto\Request\Payment\InvoiceInfoRequestDto;
use Enot\Api\Dto\Response\Payment\InvoiceCreateResponseDto;
use Enot\Api\Dto\Response\Payment\InvoiceInfoResponseDto;
use Enot\Api\Exceptions\BaseException;

class InvoiceHelper implements InvoiceHelperInterface
{
    /**
     * @param InvoiceCreateRequestDto $createRequestDto
     * @param string $shopId
     * @return array
     */
    public function createInvoiceDtoToArray(InvoiceCreateRequestDto $createRequestDto, string $shopId): array
    {
        return [
            'amount' => $createRequestDto->getAmount(),
            'order_id' => $createRequestDto->getOrderId(),
            'currency' => $createRequestDto->getCurrency(),
            'shop_id' => $shopId,
            'hook_url' => $createRequestDto->getHookUrl(),
            'custom_fields' => $createRequestDto->getCustomFields(),
            'comment' => $createRequestDto->getComment(),
            'fail_url' => $createRequestDto->getFailUrl(),
            'success_url' => $createRequestDto->getSuccessUrl(),
            'expire' => $createRequestDto->getExpire(),
            'include_service' => $createRequestDto->getIncludeService(),
            'exclude_service' => $createRequestDto->getExcludeService()
        ];
    }

    /**
     * @throws BaseException
     * @return InvoiceCreateResponseDto
     * @param array $response
     */
    public function createInvoiceArrayToDto(array $response): InvoiceCreateResponseDto
    {
        if (empty($response['data'])) {
            throw new BaseException('Empty response data');
        }

        $data = $response['data'];

        return new InvoiceCreateResponseDto(
            $data['id'],
            $data['amount'],
            $data['currency'],
            $data['url'],
            $data['expired']
        );
    }

    /**
     * @param InvoiceInfoRequestDto $dto
     * @param string $shopId
     * @return array
     */
    public function getInvoiceInfoDtoToArray(InvoiceInfoRequestDto $dto, string $shopId): array
    {
        return [
            'invoice_id' => $dto->getInvoiceId(),
            'order_id' => $dto->getOrderId(),
            'shop_id' => $shopId
        ];
    }

    /**
     * @throws BaseException
     * @return InvoiceInfoResponseDto
     * @param array $response
     */
    public function getInvoiceInfoArrayToDto(array $response): InvoiceInfoResponseDto
    {var_dump($response['data']);
        if (empty($data = $response['data'])) {
            throw new BaseException('Empty response data');
        }

        return new InvoiceInfoResponseDto(
            $data['invoice_id'],
            $data['order_id'],
            $data['shop_id'],
            $data['status'],
            $data['invoice_amount'],
            $data['credited'],
            $data['currency'],
            $data['pay_service'],
            $data['payer_details'],
            $data['commission_amount'],
            $data['commission_percent'],
            $data['shop_commission_amount'],
            $data['user_commission_amount'],
            $data['user_commission_percent'],
            $data['custom_field'],
            $data['created_at'],
            $data['expired_at'],
            $data['paid_at']
        );
    }
}
