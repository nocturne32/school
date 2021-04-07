<?php declare(strict_types=1);


namespace App\Model;


use App\Api\ApiClient;
use Nette\Utils\ArrayHash;

class OrderFacade
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function createOrder(ArrayHash $order): array
    {
        return $this->client->postOrderData($order);
    }

    public function findOrderById(int $orderId): ArrayHash
    {
        return ArrayHash::from($this->client->getOrderDataById($orderId));
    }

    public function deleteById(int $orderId): array
    {
        return $this->client->deleteOrderData($orderId);
    }
}