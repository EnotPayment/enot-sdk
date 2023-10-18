<?php

namespace Test\Enot\Api\Feature;

use Enot\Api\Dto\Request\Payoff\CreatePayoffRequestDto;
use Enot\Api\Dto\Request\Payoff\PayoffInfoRequestDto;
use Enot\Api\Dto\Response\Payoff\CreatePayoffResponseDto;
use Enot\Api\Dto\Response\Payoff\PayoffInfoResponseDto;
use Enot\Api\Dto\Response\Payoff\UserBalanceResponseDto;
use Enot\Api\Http\EnotFacade;
use Exception;
use PHPUnit\Framework\TestCase;
use Test\Enot\Api\Mocks\PayoffServiceFailMock;
use Test\Enot\Api\Mocks\PayoffServiceSuccessMock;

class PayoffTest extends TestCase
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
    public function testGetUserBalance()
    {
        $payoffService = new PayoffServiceSuccessMock();
        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey,
            null,
            $payoffService
        );

        $this->assertEquals(UserBalanceResponseDto::class, get_class($facade->getUserBalance()));
    }

    /**
     * @return void
     */
    public function testFailGetUserBalance()
    {
        $payoffService = new PayoffServiceFailMock();
        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey,
            null,
            $payoffService
        );

        try {
            $response = $facade->getUserBalance();
        } catch (Exception $e) {
            $this->assertEquals('Поле user id должно быть в формате UUID.', $e->getMessage());
            return;
        }

        $this->assertEquals(UserBalanceResponseDto::class, get_class($response));
    }

    /**
     * @return void
     */
    public function testCreatePayoff()
    {
        $payoffService = new PayoffServiceSuccessMock();
        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey,
            null,
            $payoffService
        );

        $dtoMock = $this->getMockBuilder(CreatePayoffRequestDto::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertEquals(CreatePayoffResponseDto::class, get_class($facade->createPayoff($dtoMock)));
    }

    /**
     * @return void
     */
    public function testFailCreatePayoff()
    {
        $payoffService = new PayoffServiceFailMock();
        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey,
            null,
            $payoffService
        );

        $dtoMock = $this->getMockBuilder(CreatePayoffRequestDto::class)
            ->disableOriginalConstructor()
            ->getMock();

        try {
            $response = $facade->createPayoff($dtoMock);
        } catch (Exception $e) {
            $this->assertEquals('Недействительный кошелёк.', $e->getMessage());
            return;
        }

        $this->assertEquals(CreatePayoffResponseDto::class, get_class($response));
    }

    /**
     * @return void
     */
    public function testGetPayoffInfo()
    {
        $payoffService = new PayoffServiceSuccessMock();
        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey,
            null,
            $payoffService
        );

        $dtoMock = $this->getMockBuilder(PayoffInfoRequestDto::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertEquals(PayoffInfoResponseDto::class, get_class($facade->getPayoffInfo($dtoMock)));
    }

    /**
     * @return void
     */
    public function testFailGetPayoffInfo()
    {
        $payoffService = new PayoffServiceFailMock();
        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey,
            null,
            $payoffService
        );

        $dtoMock = $this->getMockBuilder(PayoffInfoRequestDto::class)
            ->disableOriginalConstructor()
            ->getMock();

        try {
            $response = $facade->getPayoffInfo($dtoMock);
        } catch (Exception $e) {
            $this->assertEquals('Вывод не найден.', $e->getMessage());
            return;
        }

        $this->assertEquals(PayoffInfoResponseDto::class, get_class($response));
    }
}
