<?php declare(strict_types=1);


namespace App\Facade;


use App\Dto\Response\Mapper\ProductResponseDtoMapper;
use App\Dto\Response\ProductResponseDto;
use App\Entity\Product;
use App\Exception\OrderCreateFailedException;
use App\Exception\ProductCreateFailedException;
use App\Exception\ProductDeleteFailedException;
use App\Exception\ProductUpdateFailedException;
use App\Form\CreateProductType;
use App\Form\UpdateProductType;
use App\Repository\ProductRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Form\FormFactoryInterface;

class ProductFacade
{
    private EntityManagerInterface   $em;
    private ProductRepository        $repository;
    private FormFactoryInterface     $formFactory;
    private ProductResponseDtoMapper $dtoMapper;

    public function __construct(
        EntityManagerInterface $em,
        ProductRepository $repository,
        FormFactoryInterface $formFactory,
        ProductResponseDtoMapper $dtoMapper
    ) {
        $this->em = $em;
        $this->repository = $repository;
        $this->formFactory = $formFactory;
        $this->dtoMapper = $dtoMapper;
    }

    public function getById(?int $id): ?ProductResponseDto
    {
        $product = $this->repository->find($id);
        return $product ? $this->dtoMapper->mapFromEntity($product) : null;
    }

    public function create(array $data): ProductResponseDto
    {
        $product = new Product;

        $form = $this->formFactory->create(CreateProductType::class, $product);
        $form->submit($data);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new ProductCreateFailedException("All fields except description are required");
        }

        try {
            $this->em->persist($product);
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new ProductCreateFailedException(sprintf("Product with code %s already exists", $product->getCode()));
        }

        return $this->dtoMapper->mapFromEntity($product);
    }

    public function update(int $id, array $data): ?ProductResponseDto
    {
        $product = $this->repository->find($id);

        if (!$product) {
            return null;
        }

        $form = $this->formFactory->create(UpdateProductType::class, $product);
        $form->submit($data, false);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new ProductUpdateFailedException((string)$form->getErrors());
        }

        try {
            $this->em->persist($product);
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new ProductUpdateFailedException(sprintf("Product with code %s already exists", $product->getCode()));
        }

        return $this->dtoMapper->mapFromEntity($product);
    }

    public function delete(int $id): bool
    {
        $product = $this->repository->find($id);

        if (!$product) {
            return false;
        }

        try {
            $this->em->remove($product);
            $this->em->flush();
        } catch (Exception $e) {
            throw new ProductDeleteFailedException($e->getMessage());
        }

        return true;
    }

}