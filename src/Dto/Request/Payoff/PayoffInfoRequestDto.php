<?php

namespace Enot\Api\Dto\Request\Payoff;

class PayoffInfoRequestDto
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string|null
     */
    private ?string $orderId;

    /**
     * @param string $id
     * @param string|null $orderId
     */
    public function __construct(string $id, ?string $orderId)
    {
        $this->id = $id;
        $this->orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getOrderId(): ?string
    {
        return $this->orderId;
    }
}
