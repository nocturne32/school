<?php declare(strict_types=1);


namespace App\Dto\Response\Mapper;


use App\Dto\Response\CustomerResponseDto;
use App\Entity\Customer;
use Doctrine\Common\Collections\Collection;

class CustomerResponseDtoMapper
{
    public function mapFromEntity(Customer $customer): CustomerResponseDto
    {
        $mapped = new CustomerResponseDto();

        $mapped
            ->setId($customer->getId())
            ->setEmail($customer->getEmail())
            ->setFirstname($customer->getFirstname())
            ->setLastname($customer->getLastname());

        return $mapped;
    }

    /**
     * @param Collection|Customer[] $customers
     * @return array
     */
    public function mapFromCollection(iterable $customers): array
    {
        $mapped = [];

        foreach ($customers as $customer) {
            $mapped[] = $this->mapFromEntity($customer);
        }

        return $mapped;
    }


}