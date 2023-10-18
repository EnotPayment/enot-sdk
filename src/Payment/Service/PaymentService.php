<?php

namespace Enot\Api\Payment\Service;

use Enot\Api\Contracts\Client\HttpClientInterface;
use Enot\Api\Contracts\Payment\PaymentRepositoryInterface;
use Enot\Api\Contracts\Payment\PaymentServiceInterface;
use Enot\Api\Dto\Request\Payment\InvoiceCreateRequestDto;
use Enot\Api\Dto\Request\Payment\InvoiceInfoRequestDto;
use Enot\Api\Dto\Response\Payment\InvoiceCreateResponseDto;
use Enot\Api\Dto\Response\Payment\InvoiceInfoResponseDto;
use Enot\Api\Dto\Response\Payment\PaymentAvailableTariffsDto;
use Enot\Api\Exceptions\BaseException;
use Enot\Api\Exceptions\Payment\InvoiceException;
use Enot\Api\Exceptions\Payment\PaymentException;
use Enot\Api\Payment\Helpers\InvoiceHelper;
use Enot\Api\Payment\Helpers\PaymentTariffsHelper;
use Enot\Api\Payment\Repository\PaymentRepository;
use JsonException;

class PaymentService implements PaymentServiceInterface
{
    /**
     * @var PaymentRepositoryInterface|PaymentRepository
     */
    private PaymentRepositoryInterface $paymentRepository;

    /**
     * @var string
     */
    private string $shopId;

    /**
     * @param HttpClientInterface $httpClient
     * @param string $shopId
     */
    public function __construct(HttpClientInterface $httpClient, string $shopId)
    {
        $this->paymentRepository = new PaymentRepository($httpClient);
        $this->shopId = $shopId;
    }

    /**
     * @throws BaseException
     * @throws PaymentException
     * @throws JsonException
     * @return PaymentAvailableTariffsDto
     */
    public function getAvailablePaymentTariffs(): PaymentAvailableTariffsDto
    {
        $response = $this->paymentRepository->getPaymentTariffs($this->shopId);
        $paymentTariffsHelper = new PaymentTariffsHelper();

        return $paymentTariffsHelper->getTariffsFromResponse($response);
    }

    /**
     * @throws BaseException
     * @throws InvoiceException
     * @throws JsonException
     * @return InvoiceCreateResponseDto
     * @param InvoiceCreateRequestDto $dto
     */
    public function createInvoice(InvoiceCreateRequestDto $dto): InvoiceCreateResponseDto
    {
        $invoiceHelper = new InvoiceHelper();

        $requestData = $invoiceHelper->createInvoiceDtoToArray($dto, $this->shopId);
        $this->clearData($requestData);

        $response = $this->paymentRepository->createInvoice($requestData);

        return $invoiceHelper->createInvoiceArrayToDto($response);
    }

    /**
     * @throws BaseException
     * @throws InvoiceException
     * @throws JsonException
     * @return InvoiceInfoResponseDto
     * @param InvoiceInfoRequestDto $dto
     */
    public function getInvoiceInfo(InvoiceInfoRequestDto $dto): InvoiceInfoResponseDto
    {
        $invoiceHelper = new InvoiceHelper();

        $requestData = $invoiceHelper->getInvoiceInfoDtoToArray($dto, $this->shopId);
        $this->clearData($requestData);

        $response = $this->paymentRepository->getInvoiceInfo($requestData);

        return $invoiceHelper->getInvoiceInfoArrayToDto($response);
    }

    /**
     * @param $requestData
     * @return void
     */
    private function clearData(&$requestData): void
    {
        foreach ($requestData as $key => $value) {
            if (is_null($value)) {
                unset($requestData[$key]);
            }
        }
    }
}
