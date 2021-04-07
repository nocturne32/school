<?php declare(strict_types=1);


namespace App\Facade;


use App\Dto\Response\CustomerResponseDto;
use App\Dto\Response\Mapper\CustomerResponseDtoMapper;
use App\Entity\Customer;
use App\Exception\CustomerCreateFailedException;
use App\Exception\CustomerDeleteFailedException;
use App\Exception\CustomerUpdateFailedException;
use App\Form\CreateCustomerType;
use App\Form\UpdateCustomerType;
use App\Repository\CustomerRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormFactoryInterface;

class CustomerFacade
{
    private EntityManagerInterface      $em;
    private CustomerRepository          $repository;
    private FormFactoryInterface        $formFactory;
    private CustomerResponseDtoMapper   $dtoMapper;

    public function __construct(
        EntityManagerInterface $em,
        CustomerRepository $repository,
        FormFactoryInterface $formFactory,
        CustomerResponseDtoMapper $dtoMapper
    ) {
        $this->em = $em;
        $this->repository = $repository;
        $this->formFactory = $formFactory;
        $this->dtoMapper = $dtoMapper;
    }

    public function getById(?int $id): ?CustomerResponseDto
    {
        $customer = $this->repository->find($id);
        return $customer ? $this->dtoMapper->mapFromEntity($customer) : null;
    }

    public function create($data): CustomerResponseDto
    {
        $customer = new Customer;

        $form = $this->formFactory->create(CreateCustomerType::class, $customer);
        $form->submit($data);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new CustomerCreateFailedException('All fields are required');
        }

        try {
            $this->em->persist($customer);
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new CustomerCreateFailedException(sprintf("Email %s is already taken", $customer->getEmail()));
        }

        return $this->dtoMapper->mapFromEntity($customer);
    }

    public function update(int $id, $data): ?CustomerResponseDto
    {
        $customer = $this->repository->find($id);

        if (!$customer) {
            return null;
        }

        $form = $this->formFactory->create(UpdateCustomerType::class, $customer);
        $form->submit($data);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new CustomerUpdateFailedException((string)$form->getErrors());
        }

        try {
            $this->em->persist($customer);
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new CustomerUpdateFailedException(sprintf("Email %s is already taken", $customer->getEmail()));
        }

        return $this->dtoMapper->mapFromEntity($customer);
    }

    public function delete(int $id): bool
    {
        $customer = $this->repository->find($id);

        if (!$customer) {
            return false;
        }

        try {
            $this->em->remove($customer);
            $this->em->flush();
        } catch (Exception $e) {
            throw new CustomerDeleteFailedException($e->getMessage());
        }

        return true;
    }
}