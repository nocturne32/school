<?php declare(strict_types=1);


namespace App\Facade;


use App\Dto\Response\Mapper\OrderResponseDtoMapper;
use App\Dto\Response\OrderResponseDto;
use App\Entity\Order;
use App\Exception\OrderCreateFailedException;
use App\Exception\OrderDeleteFailedException;
use App\Exception\OrderUpdateFailedException;
use App\Form\CreateOrderType;
use App\Form\UpdateOrderType;
use App\Repository\OrderRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Form\FormFactoryInterface;

class OrderFacade
{
    private EntityManagerInterface $em;
    private OrderRepository        $repository;
    private FormFactoryInterface   $formFactory;
    private OrderResponseDtoMapper $dtoMapper;

    public function __construct(
        EntityManagerInterface $em,
        OrderRepository $repository,
        FormFactoryInterface $formFactory,
        OrderResponseDtoMapper $dtoMapper
    ) {
        $this->em = $em;
        $this->repository = $repository;
        $this->formFactory = $formFactory;
        $this->dtoMapper = $dtoMapper;
    }

    public function getById(?int $id): ?OrderResponseDto
    {
        $order = $this->repository->find($id);
        return $order ? $this->dtoMapper->mapFromEntity($order) : null;
    }

    public function create(array $data): OrderResponseDto
    {
        $order = new Order;

        $form = $this->formFactory->create(CreateOrderType::class, $order);
        $form->submit($data);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new OrderCreateFailedException("All fields are required, customer and products must exist");
        }

        try {
            $this->em->persist($order);
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new OrderCreateFailedException($e->getMessage());
        }
        return $this->dtoMapper->mapFromEntity($order);
    }


    public function update(int $id, array $data): ?OrderResponseDto
    {
        $order = $this->repository->find($id);

        if (!$order) {
            return null;
        }

        $form = $this->formFactory->create(UpdateOrderType::class, $order);
        $form->submit($data, false);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw new OrderUpdateFailedException("Customer or products must exist");
        }

        try {
            $this->em->persist($order);
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new OrderUpdateFailedException($e->getMessage());
        }

        return $this->dtoMapper->mapFromEntity($order);
    }

    public function delete(int $id): bool
    {
        $order = $this->repository->find($id);

        if (!$order) {
            return false;
        }

        try {
            $this->em->remove($order);
            $this->em->flush();
        } catch (Exception $e) {
            throw new OrderDeleteFailedException($e->getMessage());
        }

        return true;
    }
}