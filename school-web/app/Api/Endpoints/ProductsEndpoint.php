<?php declare(strict_types=1);


namespace App\Api\Endpoints;


use Contributte\Guzzlette\ClientFactory;
use GuzzleHttp\Client;
use Nette\Utils\ArrayHash;
use Nette\Utils\Json;

class ProductsEndpoint extends BaseEndpoint
{
    public function getAll(): array
    {
        $response = $this->client->get('products');
        return $this->handleResponse($response);
    }

    public function get(int $productId): array
    {
        $response = $this->client->get('products/' . $productId);
        return $this->handleResponse($response);
    }

    public function post(ArrayHash $data): array
    {
        $response = $this->client->post('products', [
            'json' => $data
        ]);

        return $this->handleResponse($response);
    }

    public function put(int $productId, ArrayHash $data): array
    {
        $response = $this->client->put('products/' . $productId, [
            'json' => $data
        ]);

        return $this->handleResponse($response);
    }

    public function delete(int $productId): array
    {
        $response = $this->client->delete('products/' . $productId);
        return $this->handleResponse($response);
    }
}