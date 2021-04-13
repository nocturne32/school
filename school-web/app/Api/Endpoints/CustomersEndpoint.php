<?php declare(strict_types=1);


namespace App\Api\Endpoints;


use Contributte\Guzzlette\ClientFactory;
use GuzzleHttp\Client;
use Nette\Utils\ArrayHash;
use Nette\Utils\Json;

class CustomersEndpoint extends BaseEndpoint
{
    public function getAll(): array
    {
        $response = $this->client->get('customers');
        return $this->handleResponse($response);
    }

    public function get(int $customerId): array
    {
        $response = $this->client->get('customers/' . $customerId);
        return $this->handleResponse($response);
    }

    public function post(ArrayHash $data): array
    {
        $response = $this->client->post('customers', [
            'json' => $data
        ]);

        return $this->handleResponse($response);
    }

    public function put(int $customerId, ArrayHash $data): array
    {
        $response = $this->client->put('customers/' . $customerId, [
            'json' => $data
        ]);

        return $this->handleResponse($response);
    }

    public function delete(int $customerId): array
    {
        $response = $this->client->delete('customers/' . $customerId);
        return $this->handleResponse($response);
    }

    public function getOrdersByCustomerId(int $customerId): array
    {
        $response = $this->client->get('customers/' . $customerId . '/orders');
        return $this->handleResponse($response);
    }
}