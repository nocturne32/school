<?php declare(strict_types=1);


namespace App\Dto\Response\Mapper;


use App\Dto\Response\CustomerOrderResponseDto;
use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Common\Collections\Collection;

class CustomerOrderResponseDtoMapper
{
    private ProductResponseDtoMapper $productResponseDtoMapper;

    public function __construct(ProductResponseDtoMapper $productResponseDtoMapper)
    {
        $this->productResponseDtoMapper = $productResponseDtoMapper;
    }

    public function mapFromEntity(Order $order): CustomerOrderResponseDto
    {
        $mapped = new CustomerOrderResponseDto();

        $mapped
            ->setId($order->getId())
            ->setOrderedAt($order->getOrderedAt())
            ->setProducts($this->productResponseDtoMapper->mapFromCollection($order->getProducts()))
            ->setTotalPrice($order->getTotalPrice());

        return $mapped;
    }

    /**
     * @param Collection|Product[] $products
     * @return array
     */
    public function mapFromCollection(iterable $products): array
    {
        $mapped = [];

        foreach ($products as $product) {
            $mapped[] = $this->mapFromEntity($product);
        }

        return $mapped;
    }


}