<?php

namespace Enot\Api\Contracts\Signature;

interface SignatureGeneratorInterface
{
    /**
     * @param array $data
     * @return string
     */
    public function generateSignature(array $data): string;

    /**
     * @param string $webhookRequest
     * @param string $signature
     * @return bool
     */
    public function checkWebhookSignature(string $webhookRequest, string $signature): bool;
}
