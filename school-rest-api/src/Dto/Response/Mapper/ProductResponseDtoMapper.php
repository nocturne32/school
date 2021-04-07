<?php declare(strict_types=1);


namespace App\Dto\Response\Mapper;


use App\Dto\Response\ProductResponseDto;
use App\Entity\Product;
use Doctrine\Common\Collections\Collection;

class ProductResponseDtoMapper
{
    public function mapFromEntity(Product $product): ProductResponseDto
    {
        $mapped = new ProductResponseDto();

        $mapped
            ->setId($product->getId())
            ->setCode($product->getCode())
            ->setName($product->getName())
            ->setDescription($product->getDescription())
            ->setPrice($product->getPrice());

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