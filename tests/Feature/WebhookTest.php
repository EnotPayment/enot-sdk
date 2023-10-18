<?php

namespace Test\Enot\Api\Feature;

use Enot\Api\Http\EnotFacade;
use JsonException;
use PHPUnit\Framework\TestCase;

class WebhookTest extends TestCase
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
    private ?string $webhookPaymentKey = 'paymentExample';

    /**
     * @var string|null
     */
    private ?string $webhookPayoffKey = 'payoffExample';

    public function __construct()
    {
        parent::__construct();

        $this->shopId = uniqid('', true);
        $this->userId = uniqid('', true);
        $this->paymentSecretKey = uniqid('', true);
        $this->payoffSecretKey = uniqid('', true);
    }

    /**
     * @throws JsonException
     * @return void
     */
    public function testPaymentWebhook()
    {
        $webhookSignature = 'e2b9eb083e9cd84e6ce2a07c7bcf363bc7dc19aae67487352c5b4aed6258d244';

        $webhookRequest = [
            'order_id' => 'c78d8fe9-ab44-3f21-a37a-ce4ca269cb47',
            'credited' => '95.50',
            'custom_fields' => [
                'user' => 1
            ],
            'invoice_id' => 'a3e9ff6f-c5c1-3bcd-854e-4bc995b1ae7a',
            'pay_service' => 'card',
            'pay_time' => '2023-04-06 16=>27=>59',
            'payer_details' => '553691******1279',
            'status' => 'success',
            'type' => 1,
            'amount' => '100.00'
        ];

        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey
        );

        $this->assertTrue($facade->checkPaymentWebhookSignature(json_encode($webhookRequest), $webhookSignature));
    }

    public function testPayoffWebhook()
    {
        $webhookSignature = '98e2c0563c06851e1934fe968d7239ed06f7dae05f7b43c3d046d39776980e98';

        $webhookRequest = [
            'order_id' => 'c78d8fe9-ab44-3f21-a37a-ce4ca269cb47',
            'credited' => '95.50',
            'custom_fields' => [
                'user' => 1
            ],
            'invoice_id' => 'a3e9ff6f-c5c1-3bcd-854e-4bc995b1ae7a',
            'pay_service' => 'card',
            'pay_time' => '2023-04-06 16=>27=>59',
            'payer_details' => '553691******1279',
            'status' => 'success',
            'type' => 1,
            'amount' => '100.00'
        ];

        $facade = new EnotFacade(
            $this->shopId,
            $this->paymentSecretKey,
            $this->userId,
            $this->payoffSecretKey,
            $this->webhookPaymentKey,
            $this->webhookPayoffKey
        );

        $this->assertTrue($facade->checkPayoffWebhookSignature(json_encode($webhookRequest), $webhookSignature));
    }
}
