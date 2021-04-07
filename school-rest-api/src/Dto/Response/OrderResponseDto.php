<?php declare(strict_types=1);


namespace App\Dto\Response;


use DateTimeInterface;
use JMS\Serializer\Annotation as Serialization;

class OrderResponseDto
{
    /**
     * @Serialization\Type("int")
     */
    private int $id;

    /**
     * @Serialization\Type("App\Dto\Response\CustomerResponseDto")
     */
    private CustomerResponseDto $customer;

    /**
     * @Serialization\Type("array<App\Dto\Response\ProductResponseDto>")
     */
    private array $products;

    /**
     * @Serialization\Type("DateTimeInterface")
     */
    private DateTimeInterface $ordered_at;

    /**
     * @Serialization\Type("float")
     */
    private float $totalPrice;

    /**
     * @Serialization\Type("bool")
     */
    private bool $isPaid = false;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): OrderResponseDto
    {
        $this->id = $id;
        return $this;
    }

    public function getCustomer(): CustomerResponseDto
    {
        return $this->customer;
    }

    public function setCustomer(CustomerResponseDto $customer): OrderResponseDto
    {
        $this->customer = $customer;
        return $this;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): OrderResponseDto
    {
        $this->products = $products;
        return $this;
    }

    public function getOrderedAt(): DateTimeInterface
    {
        return $this->ordered_at;
    }

    public function setOrderedAt(DateTimeInterface $orderedAt): OrderResponseDto
    {
        $this->ordered_at = $orderedAt;
        return $this;
    }

    public function isPaid(): bool
    {
        return $this->isPaid;
    }

    public function setIsPaid(bool $isPaid): self
    {
        $this->isPaid = $isPaid;
        return $this;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): OrderResponseDto
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

}