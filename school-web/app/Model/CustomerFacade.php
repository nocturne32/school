<?php declare(strict_types=1);


namespace App\Model;


use App\Api\ApiClient;
use DusanKasan\Knapsack\Collection;
use Nette\Utils\ArrayHash;

class CustomerFacade
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function createOrUpdateCustomer(ArrayHash $customerData): ArrayHash
    {
        $customer = $this->findCustomerByEmail($customerData->email);

        if ($customer->count()) {
            $this->client->getCustomers()->put((int)$customer['id'], $customerData);
            $customer = ArrayHash::from($this->client->getCustomers()->get($customer['id'])['data']);
        } else {
            $this->client->getCustomers()->post($customerData);
            $customer = $this->findCustomerByEmail($customerData->email);
        }

        return $customer;
    }

    public function getCustomerById(int $customerId): ArrayHash
    {
        return ArrayHash::from($this->client->getCustomers()->get($customerId)['data']);
    }

    public function findCustomerByEmail(string $email): ArrayHash
    {
        return ArrayHash::from(Collection::from($this->client->getCustomers()->getAll()['data'])
            ->filter(function ($customer) use ($email) {
                return $customer['email'] === $email;
            })->flatten()
            ->toArray());
    }

    public function findCustomerOrdersById(int $customerId): ArrayHash
    {
        return ArrayHash::from($this->client->getCustomers()->getOrdersByCustomerId($customerId)['data']);
    }

    public function deleteById(int $customerId): array
    {
        return $this->client->getCustomers()->delete($customerId);
    }
}