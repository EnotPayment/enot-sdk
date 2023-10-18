<?php

namespace Enot\Api\Http\Signature;

use Enot\Api\Contracts\Signature\SignatureGeneratorInterface;
use JsonException;

class SignatureHelper implements SignatureGeneratorInterface
{
    /**
     * @var string
     */
    private string $secretKey;

    /**
     * @param string $secretKey
     */
    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @throws JsonException
     * @return string
     * @param array $data
     */
    public function generateSignature(array $data): string
    {
        ksort($data);
        return hash_hmac("sha256", json_encode($data, JSON_THROW_ON_ERROR), $this->secretKey);
    }

    /**
     * @throws JsonException
     * @param string $signature
     * @return bool
     * @param string $webhookRequest
     */
    public function checkWebhookSignature(string $webhookRequest, string $signature): bool
    {
        $data = json_decode($webhookRequest, true, 512, JSON_THROW_ON_ERROR);
        $webhookSignature = $this->generateSignature($data);

        return $webhookSignature === $signature;
    }
}
