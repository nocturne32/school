<?php declare(strict_types=1);


namespace App\Model;


use App\Api\ApiClient;
use DusanKasan\Knapsack\Collection;
use Nette\Utils\ArrayHash;

class CustomerListFacade
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function findCustomers(): ArrayHash
    {
        return ArrayHash::from($this->client->getCustomers()->getAll());
    }

    public function findCustomersAsPairs(): array
    {
        return Collection::from($this->client->getCustomers()->getAll())
            ->mapcat(function ($customer) {
                return [$customer['id'] => $customer['email']];
            })
            ->toArray();
    }


}