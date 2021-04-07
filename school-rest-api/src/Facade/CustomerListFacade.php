<?php declare(strict_types=1);


namespace App\Facade;


use App\Dto\Response\Mapper\CustomerResponseDtoMapper;
use App\Repository\CustomerRepository;

class CustomerListFacade
{
    private CustomerRepository        $repository;
    private CustomerResponseDtoMapper $dtoMapper;

    public function __construct(
        CustomerRepository $repository,
        CustomerResponseDtoMapper $dtoMapper
    ) {
        $this->repository = $repository;
        $this->dtoMapper = $dtoMapper;
    }

    public function findAll(): array
    {
        $orders = $this->repository->findAll();
        return $this->dtoMapper->mapFromCollection($orders);
    }


}