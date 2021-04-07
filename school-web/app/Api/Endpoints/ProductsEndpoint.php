<?php declare(strict_types=1);


namespace App\Api\Endpoints;


use Contributte\Guzzlette\ClientFactory;
use GuzzleHttp\Client;
use Nette\Utils\ArrayHash;
use Nette\Utils\Json;

class ProductsEndpoint extends BaseEndpoint
{
    public function getAll()
    {
        $response = $this->client->get('products');
        return $this->handleResponse($response)['data'];
    }

    public function get(int $productId)
    {
        $response = $this->client->get('products/' . $productId);
        return $this->handleResponse($response)['data'];
    }

    public function post(ArrayHash $data)
    {
        $contents = $this->client->post('products', [
            'json' => $data
        ])->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function put(int $productId, ArrayHash $data)
    {
        $contents = $this->client->put('products/' . $productId, [
            'json' => $data
        ])->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function delete(int $productId)
    {
        $contents = $this->client->delete('products/' . $productId)->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }
}