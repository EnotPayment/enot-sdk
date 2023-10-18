<?php

namespace Enot\Api\Payment\Repository;

use Enot\Api\Constants\HttpClient\HttpClientConstants;
use Enot\Api\Constants\Payment\PaymentConstants;
use Enot\Api\Contracts\Client\HttpClientInterface;
use Enot\Api\Contracts\Payment\PaymentRepositoryInterface;
use Enot\Api\Exceptions\BaseException;
use Enot\Api\Exceptions\Payment\InvoiceException;
use Enot\Api\Exceptions\Payment\PaymentException;
use JsonException;

class PaymentRepository implements PaymentRepositoryInterface
{
    /**
     * @var HttpClientInterface
     */
    private HttpClientInterface $httpClient;

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @throws PaymentException
     * @throws JsonException
     * @throws BaseException
     * @param string $shopId
     * @return array
     */
    public function getPaymentTariffs(string $shopId): array
    {
        $method = sprintf(PaymentConstants::AVAILABLE_PAYMENT_METHOD, $shopId);
        $response = $this->httpClient->request($method);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new PaymentException(is_array($response['error']) ?
                json_encode($response['error'], JSON_THROW_ON_ERROR) :
                $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @throws InvoiceException
     * @throws JsonException|BaseException
     * @param array $requestData
     * @return array
     */
    public function createInvoice(array $requestData): array
    {
        $response = $this->httpClient->request(
            PaymentConstants::INVOICE_CREATE_METHOD,
            $requestData, HttpClientConstants::POST_REQUEST
        );

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new InvoiceException(is_array($response['error']) ?
                json_encode($response['error'], JSON_THROW_ON_ERROR) :
                $response['error'], $response['status']);
        }

        return $response;
    }

    /**
     * @throws InvoiceException
     * @throws JsonException|BaseException
     * @param array $requestData
     * @return array
     */
    public function getInvoiceInfo(array $requestData): array
    {
        $response = $this->httpClient->request(PaymentConstants::INVOICE_INFO_METHOD, $requestData);

        if (!empty($response['error']) || $response['status'] !== 200) {
            throw new InvoiceException(is_array($response['error']) ?
                json_encode($response['error'], JSON_THROW_ON_ERROR) :
                $response['error'], $response['status']);
        }

        return $response;
    }
}
