<?php

namespace Enot\Api\Http;

use Enot\Api\Authentication\Helper\AuthenticationHelper;
use Enot\Api\Contracts\Authentication\AuthenticationHelperInterface;
use Enot\Api\Contracts\EnotFacadeInterface;
use Enot\Api\Contracts\Payment\PaymentServiceInterface;
use Enot\Api\Contracts\Payoff\PayoffServiceInterface;
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
use Enot\Api\Http\Signature\SignatureHelper;
use Enot\Api\Payment\Service\PaymentService;
use Enot\Api\Payoff\Service\PayoffService;
use JsonException;

class EnotFacade implements EnotFacadeInterface
{
    /**
     * @var AuthenticationHelperInterface|AuthenticationHelper
     */
    private AuthenticationHelperInterface $authenticationHelper;

    /**
     * @var string
     */
    private string $shopId;

    /**
     * @var string
     */
    private string $shopSecretKey;

    /**
     * @var string
     */
    private string $userId;

    /**
     * @var string
     */
    private string $userSecretKey;

    /**
     * @var string|null
     */
    private ?string $webhookPaymentKey;

    /**
     * @var string|null
     */
    private ?string $webhookPayoffKey;

    /**
     * @var PaymentServiceInterface|null
     */
    private ?PaymentServiceInterface $paymentService;

    /**
     * @var PayoffServiceInterface|null
     */
    private ?PayoffServiceInterface $payoffService;

    /**
     * @param string $shopId
     * @param string $shopSecretKey
     * @param string $userId
     * @param string $userSecretKey
     * @param string|null $webhookPaymentKey
     * @param string|null $webhookPayoffKey
     * @param PaymentServiceInterface|null $paymentService
     * @param PayoffServiceInterface|null $payoffService
     */
    public function __construct(
        string $shopId,
        string $shopSecretKey,
        string $userId,
        string $userSecretKey,
        ?string $webhookPaymentKey = null,
        ?string $webhookPayoffKey = null,
        ?PaymentServiceInterface $paymentService = null,
        ?PayoffServiceInterface  $payoffService = null
    )
    {
        $this->authenticationHelper = new AuthenticationHelper();
        $this->shopId = $shopId;
        $this->shopSecretKey = $shopSecretKey;
        $this->userId = $userId;
        $this->userSecretKey = $userSecretKey;
        $this->webhookPaymentKey = $webhookPaymentKey;
        $this->webhookPayoffKey = $webhookPayoffKey;
        $this->paymentService = $paymentService;
        $this->payoffService = $payoffService;
    }

    /**
     * @return PaymentAvailableTariffsDto
     */
    public function getAvailablePaymentTariffs(): PaymentAvailableTariffsDto
    {
        $client = $this->authenticationHelper->paymentAuthentication($this->shopSecretKey);
        $paymentService = $this->paymentService ?? new PaymentService($client, $this->shopId);

        return $paymentService->getAvailablePaymentTariffs();
    }

    /**
     * @param InvoiceCreateRequestDto $dto
     * @return InvoiceCreateResponseDto
     */
    public function createInvoice(InvoiceCreateRequestDto $dto): InvoiceCreateResponseDto
    {
        $client = $this->authenticationHelper->paymentAuthentication($this->shopSecretKey);
        $paymentService = $this->paymentService ?? new PaymentService($client, $this->shopId);

        return $paymentService->createInvoice($dto);
    }

    /**
     * @param InvoiceInfoRequestDto $dto
     * @return InvoiceInfoResponseDto
     */
    public function getInvoiceInfo(InvoiceInfoRequestDto $dto): InvoiceInfoResponseDto
    {
        $client = $this->authenticationHelper->paymentAuthentication($this->shopSecretKey);
        $paymentService = $this->paymentService ?? new PaymentService($client, $this->shopId);

        return $paymentService->getInvoiceInfo($dto);
    }

    /**
     * @throws JsonException
     * @param string $signature
     * @return bool
     * @param string $webhookRequest
     */
    public function checkPaymentWebhookSignature(string $webhookRequest, string $signature): bool
    {
        $signatureHelper = new SignatureHelper($this->webhookPaymentKey);
        return $signatureHelper->checkWebhookSignature($webhookRequest, $signature);
    }

    /**
     * @return UserBalanceResponseDto
     */
    public function getUserBalance(): UserBalanceResponseDto
    {
        $client = $this->authenticationHelper->payoffAuthentication($this->userSecretKey);
        $payoffService = $this->payoffService ?? new PayoffService($client, $this->userId);

        return $payoffService->getUserBalance();
    }

    /**
     * @param CreatePayoffRequestDto $dto
     * @return CreatePayoffResponseDto
     */
    public function createPayoff(CreatePayoffRequestDto $dto): CreatePayoffResponseDto
    {
        $client = $this->authenticationHelper->payoffAuthentication($this->userSecretKey);
        $payoffService = $this->payoffService ?? new PayoffService($client, $this->userId);

        return $payoffService->createPayoff($dto);
    }

    /**
     * @param PayoffInfoRequestDto $dto
     * @return PayoffInfoResponseDto
     */
    public function getPayoffInfo(PayoffInfoRequestDto $dto): PayoffInfoResponseDto
    {
        $client = $this->authenticationHelper->payoffAuthentication($this->userSecretKey);
        $payoffService = $this->payoffService ?? new PayoffService($client, $this->userId);

        return $payoffService->getPayoffInfo($dto);
    }

    /**
     * @throws JsonException
     * @param string $signature
     * @return bool
     * @param string $webhookRequest
     */
    public function checkPayoffWebhookSignature(string $webhookRequest, string $signature): bool
    {
        $signatureHelper = new SignatureHelper($this->webhookPayoffKey);
        return $signatureHelper->checkWebhookSignature($webhookRequest, $signature);
    }
}
