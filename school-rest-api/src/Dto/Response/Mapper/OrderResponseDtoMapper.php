<?php declare(strict_types=1);


namespace App\Dto\Response\Mapper;


use App\Dto\Response\OrderResponseDto;
use App\Entity\Order;
use Doctrine\Common\Collections\Collection;

class OrderResponseDtoMapper
{
    private CustomerResponseDtoMapper $customerResponseDtoMapper;
    private ProductResponseDtoMapper  $productResponseDtoMapper;

    public function __construct(
        CustomerResponseDtoMapper $customerResponseDtoMapper,
        ProductResponseDtoMapper $productResponseDtoMapper
    ) {
        $this->customerResponseDtoMapper = $customerResponseDtoMapper;
        $this->productResponseDtoMapper = $productResponseDtoMapper;
    }

    public function mapFromEntity(Order $order): OrderResponseDto
    {
        $mapped = new OrderResponseDto();

        $mapped
            ->setId($order->getId())
            ->setCustomer($this->customerResponseDtoMapper->mapFromEntity($order->getCustomer()))
            ->setOrderedAt($order->getOrderedAt())
            ->setProducts($this->productResponseDtoMapper->mapFromCollection($order->getProducts()))
            ->setTotalPrice($order->getTotalPrice());

        return $mapped;
    }

    /**
     * @param Collection|Order[] $orders
     * @return array
     */
    public function mapFromCollection(iterable $orders): array
    {
        $mapped = [];

        foreach ($orders as $order) {
            $mapped[] = $this->mapFromEntity($order);
        }

        return $mapped;
    }


}