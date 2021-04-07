<?php declare(strict_types=1);


namespace App\Facade;


use App\Dto\Response\Mapper\CustomerOrderResponseDtoMapper;
use App\Dto\Response\Mapper\OrderResponseDtoMapper;
use App\Repository\OrderRepository;

class OrderListFacade
{
    private OrderRepository                $repository;
    private OrderResponseDtoMapper         $dtoMapper;
    private CustomerOrderResponseDtoMapper $customerOrderDtoMapper;

    public function __construct(
        OrderRepository $repository,
        OrderResponseDtoMapper $dtoMapper,
        CustomerOrderResponseDtoMapper $customerOrderDtoMapper
    ) {
        $this->repository = $repository;
        $this->dtoMapper = $dtoMapper;
        $this->customerOrderDtoMapper = $customerOrderDtoMapper;
    }

    public function findAll(): array
    {
        $orders = $this->repository->findAll();
        return $this->dtoMapper->mapFromCollection($orders);
    }

    public function findByCustomerId(int $customerId): array
    {
        $orders = $this->repository->findBy(['customer' => $customerId]);
        return $this->customerOrderDtoMapper->mapFromCollection($orders);
    }

}