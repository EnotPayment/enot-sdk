<?php

namespace Test\Enot\Api\Feature;

use Enot\Api\Dto\Request\Payment\InvoiceCreateRequestDto;
use Enot\Api\Dto\Request\Payment\InvoiceInfoRequestDto;
use Enot\Api\Dto\Response\Payment\InvoiceCreateResponseDto;
use Enot\Api\Dto\Response\Payment\InvoiceInfoResponseDto;
use Enot\Api\Dto\Response\Payment\PaymentAvailableTariffsDto;
use Enot\Api\Http\EnotFacade;
use Exception;
use Test\Enot\Api\Mocks\PaymentServiceFailMock;
use Test\Enot\Api\Mocks\PaymentServiceSuccessMock;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    /**
     * @var string
     */
    private string $shopId;

    /**
     * @var string
     */
    private string $userId;

    /**
     * @var string
     */
    private string $paymentSecretKey;

    /**
     * @var string
     */
    private string $payoffSecretKey;

    /**
     * @var string|null
     */
    private ?string $webhookPaymentKey = null;

    /**
     * @var string|null
     */
    private ?string $webhookPayoffKey = null;

    public function __construct()
    {
        parent::__construct();

        $this->shopId = uniqid('', true);
        $this->userId = uniqid('', true);
        $this->paymentSecretKey = uniqid('', true);
        $this->payoffSecretKey = uniqid('', true);
    }

    /**
     * @return void
     */
    public function testGetAvailablePaymentTariffs()
    {
        $mockService = new PaymentServiceSuccessMock();
        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey,
            $mockService
        );

        $this->assertEquals(PaymentAvailableTariffsDto::class, get_class($facade->getAvailablePaymentTariffs()));
    }

    /**
     * @return void
     */
    public function testFailGetAvailablePaymentTariffs()
    {
        $mockService = new PaymentServiceFailMock();
        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey,
            $mockService
        );

        try {
            $response = $facade->getAvailablePaymentTariffs();
        } catch (Exception $e) {
            $this->assertEquals('Внутренняя ошибка системы, попробуйте позже', $e->getMessage());
            return;
        }

        $this->assertEquals(PaymentAvailableTariffsDto::class, get_class($response));
    }

    /**
     * @return void
     */
    public function testCreateInvoice()
    {
        $mockService = new PaymentServiceSuccessMock();
        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey,
            $mockService
        );

        $dtoMock = $this->getMockBuilder(InvoiceCreateRequestDto::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertInstanceOf(InvoiceCreateResponseDto::class, $facade->createInvoice($dtoMock));
    }

    /**
     * @return void
     */
    public function testFailCreateInvoice()
    {
        $mockService = new PaymentServiceFailMock();
        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey,
            $mockService
        );

        $dtoMock = $this->getMockBuilder(InvoiceCreateRequestDto::class)
            ->disableOriginalConstructor()
            ->getMock();

        try {
            $facade->createInvoice($dtoMock);
        } catch (Exception $e) {
            $this->assertEquals('Номер заказа должен быть уникальным', $e->getMessage());
            return;
        }

        $this->assertInstanceOf(InvoiceCreateResponseDto::class, $facade->createInvoice($dtoMock));
    }

    /**
     * @return void
     */
    public function testGetInvoiceInfo()
    {
        $mockService = new PaymentServiceSuccessMock();
        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey,
            $mockService
        );

        $dtoMock = $this->getMockBuilder(InvoiceInfoRequestDto::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertInstanceOf(InvoiceInfoResponseDto::class, $facade->getInvoiceInfo($dtoMock));
    }

    /**
     * @return void
     */
    public function testFailGetInvoiceInfo()
    {
        $mockService = new PaymentServiceFailMock();
        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey,
            $mockService
        );

        $dtoMock = $this->getMockBuilder(InvoiceInfoRequestDto::class)
            ->disableOriginalConstructor()
            ->getMock();

        try {
            $facade->getInvoiceInfo($dtoMock);
        } catch (Exception $e) {
            $this->assertEquals('Инвойс не найден', $e->getMessage());
            return;
        }

        $this->assertInstanceOf(InvoiceCreateResponseDto::class, $facade->getInvoiceInfo($dtoMock));
    }
}
