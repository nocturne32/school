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
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return OrderResponseDto
     */
    public function setId(int $id): OrderResponseDto
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return CustomerResponseDto
     */
    public function getCustomer(): CustomerResponseDto
    {
        return $this->customer;
    }

    /**
     * @param CustomerResponseDto $customer
     * @return OrderResponseDto
     */
    public function setCustomer(CustomerResponseDto $customer): OrderResponseDto
    {
        $this->customer = $customer;
        return $this;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param array $products
     * @return OrderResponseDto
     */
    public function setProducts(array $products): OrderResponseDto
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getOrderedAt(): DateTimeInterface
    {
        return $this->ordered_at;
    }

    /**
     * @param DateTimeInterface $ordered_at
     * @return OrderResponseDto
     */
    public function setOrderedAt(DateTimeInterface $ordered_at): OrderResponseDto
    {
        $this->ordered_at = $ordered_at;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     * @return OrderResponseDto
     */
    public function setTotalPrice(float $totalPrice): OrderResponseDto
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

}