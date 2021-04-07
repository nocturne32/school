<?php declare(strict_types=1);


namespace App\Api\Endpoints;


use Contributte\Guzzlette\ClientFactory;
use GuzzleHttp\Client;
use Nette\Utils\ArrayHash;
use Nette\Utils\Json;

class OrdersEndpoint extends BaseEndpoint
{
    public function getAll()
    {
        $response = $this->client->get('orders');
        return $this->handleResponse($response)['data'];
    }

    public function get(int $orderId)
    {
        $response = $this->client->get('orders/' . $orderId);
        return $this->handleResponse($response)['data'];
    }

    public function post(ArrayHash $data)
    {
        $contents = $this->client->post('orders', [
            'json' => $data
        ])->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function put(int $orderId, ArrayHash $data)
    {
        $contents = $this->client->put('orders/' . $orderId, [
            'json' => $data
        ])->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function delete(int $orderId)
    {
        $contents = $this->client->delete('orders/' . $orderId)->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }
}