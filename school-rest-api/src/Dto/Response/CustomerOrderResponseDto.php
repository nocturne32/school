<?php declare(strict_types=1);


namespace App\Dto\Response;


use DateTimeInterface;
use JMS\Serializer\Annotation as Serialization;

class CustomerOrderResponseDto
{

    /**
     * @Serialization\Type("int")
     */
    private int $id;

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
     * @return CustomerOrderResponseDto
     */
    public function setId(int $id): CustomerOrderResponseDto
    {
        $this->id = $id;
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
     * @return CustomerOrderResponseDto
     */
    public function setProducts(array $products): CustomerOrderResponseDto
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
     * @return CustomerOrderResponseDto
     */
    public function setOrderedAt(DateTimeInterface $ordered_at): CustomerOrderResponseDto
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
     * @return CustomerOrderResponseDto
     */
    public function setTotalPrice(float $totalPrice): CustomerOrderResponseDto
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }


}