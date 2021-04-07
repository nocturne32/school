<?php declare(strict_types=1);


namespace App\Model;


use App\Api\ApiClient;
use DusanKasan\Knapsack\Collection;
use Nette\Utils\ArrayHash;

class OrderListFacade
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }
    
    public function findOrders(): ArrayHash
    {
        return ArrayHash::from($this->client->getOrdersData());
    }

    public function findCustomerOrdersById(int $customerId): ArrayHash
    {
        return ArrayHash::from($this->client->getOrdersDataByCustomerId($customerId));
    }

}