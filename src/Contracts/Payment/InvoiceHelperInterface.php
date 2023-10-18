<?php

namespace Enot\Api\Contracts\Payment;

use Enot\Api\Dto\Request\Payment\InvoiceCreateRequestDto;
use Enot\Api\Dto\Request\Payment\InvoiceInfoRequestDto;
use Enot\Api\Dto\Response\Payment\InvoiceCreateResponseDto;
use Enot\Api\Dto\Response\Payment\InvoiceInfoResponseDto;

interface InvoiceHelperInterface
{
    /**
     * @param InvoiceCreateRequestDto $createRequestDto
     * @param string $shopId
     * @return array
     */
    public function createInvoiceDtoToArray(InvoiceCreateRequestDto $createRequestDto, string $shopId): array;

    /**
     * @param array $response
     * @return InvoiceCreateResponseDto
     */
    public function createInvoiceArrayToDto(array $response): InvoiceCreateResponseDto;

    /**
     * @param InvoiceInfoRequestDto $dto
     * @param string $shopId
     * @return array
     */
    public function getInvoiceInfoDtoToArray(InvoiceInfoRequestDto $dto, string $shopId): array;

    /**
     * @param array $response
     * @return InvoiceInfoResponseDto
     */
    public function getInvoiceInfoArrayToDto(array $response): InvoiceInfoResponseDto;
}
