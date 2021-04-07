<?php declare(strict_types=1);


namespace App\Api\Endpoints;


use Contributte\Guzzlette\ClientFactory;
use GuzzleHttp\Client;
use Nette\Utils\ArrayHash;
use Nette\Utils\Json;

class CustomersEndpoint extends BaseEndpoint
{
    public function getAll()
    {
        $response = $this->client->get('customers');
        return $this->handleResponse($response)['data'];
    }

    public function get(int $customerId)
    {
        $response = $this->client->get('customers/' . $customerId);
        return $this->handleResponse($response)['data'];
    }

    public function post(ArrayHash $data)
    {
        $contents = $this->client->post('customers', [
            'json' => $data
        ])->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function put(int $customerId, ArrayHash $data)
    {
        $contents = $this->client->put('customers/' . $customerId, [
            'json' => $data
        ])->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function delete(int $customerId)
    {
        $contents = $this->client->delete('customers/' . $customerId)->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function getOrdersByCustomerId(int $customerId): array
    {
        $response = $this->client->get('customers/' . $customerId . '/orders');
        return $this->handleResponse($response)['data'];
    }
}