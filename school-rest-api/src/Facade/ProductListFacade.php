<?php declare(strict_types=1);


namespace App\Facade;


use App\Dto\Response\Mapper\ProductResponseDtoMapper;
use App\Repository\ProductRepository;

class ProductListFacade
{
    private ProductRepository        $repository;
    private ProductResponseDtoMapper $dtoMapper;

    public function __construct(
        ProductRepository $repository,
        ProductResponseDtoMapper $dtoMapper
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