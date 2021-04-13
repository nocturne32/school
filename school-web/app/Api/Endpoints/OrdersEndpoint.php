<?php declare(strict_types=1);


namespace App\Api\Endpoints;


use Contributte\Guzzlette\ClientFactory;
use GuzzleHttp\Client;
use Nette\Utils\ArrayHash;
use Nette\Utils\Json;

class OrdersEndpoint extends BaseEndpoint
{
    public function getAll(): array
    {
        $response = $this->client->get('orders');
        return $this->handleResponse($response)['data'];
    }

    public function get(int $orderId): array
    {
        $response = $this->client->get('orders/' . $orderId);
        return $this->handleResponse($response)['data'];
    }

    public function post(ArrayHash $data): array
    {
        $response = $this->client->post('orders', [
            'json' => $data
        ]);

        return $this->handleResponse($response);
    }

    public function put(int $orderId, ArrayHash $data): array
    {
        $response = $this->client->put('orders/' . $orderId, [
            'json' => $data
        ]);

        return $this->handleResponse($response);
    }

    public function delete(int $orderId): array
    {
        $response = $this->client->delete('orders/' . $orderId);
        return $this->handleResponse($response);
    }
}