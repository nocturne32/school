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
            $this->client->putCustomerData((int)$customer['id'], $customerData);
            $customer = ArrayHash::from($this->client->getCustomerDataById($customer['id']));
        } else {
            $this->client->postCustomerData($customerData);
            $customer = $this->findCustomerByEmail($customerData->email);
        }

        return $customer;
    }

    public function getCustomerById(int $customerId): ArrayHash
    {
        return ArrayHash::from($this->client->getCustomerDataById($customerId));
    }

    public function findCustomerByEmail(string $email): ArrayHash
    {
        return ArrayHash::from(Collection::from($this->client->getCustomersData())
            ->filter(function ($customer) use ($email) {
                return $customer['email'] === $email;
            })->flatten()
            ->toArray());
    }

    public function deleteById(int $customerId): array
    {
        return $this->client->deleteCustomerData($customerId);
    }
}