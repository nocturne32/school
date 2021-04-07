<?php declare(strict_types=1);


namespace App\Api;


use Contributte\Guzzlette\ClientFactory;
use DusanKasan\Knapsack\Collection;
use GuzzleHttp\Client;
use Nette\Utils\ArrayHash;
use Nette\Utils\Json;
use Psr\Http\Message\ResponseInterface;
use function DusanKasan\Knapsack\contains;

class ApiClient
{
    /** @var Client */
    private $guzzle;

    public function __construct(string $baseUri, ClientFactory $clientFactory)
    {
        $this->guzzle = $clientFactory->createClient([
            'base_uri' => $baseUri
        ]);
    }

    private function handleResponse(ResponseInterface $response)
    {
        return Json::decode($response->getBody()->getContents(), Json::FORCE_ARRAY);
    }

    public function getCustomersData(): array
    {
        $response = $this->guzzle->get('customers');
        return $this->handleResponse($response)['data'];
    }

    public function getCustomerDataById(int $customerId): array
    {
        $response = $this->guzzle->get('customers/' . $customerId);
        return $this->handleResponse($response)['data'];
    }

    public function postCustomerData(ArrayHash $data): array
    {
        $contents = $this->guzzle->post('customers', [
            'json' => $data
        ])->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function putCustomerData(int $customerId, ArrayHash $data): array
    {
        $contents = $this->guzzle->put('customers/' . $customerId, [
            'json' => $data
        ])->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function deleteCustomerData(int $customerId): array
    {
        $contents = $this->guzzle->delete('customers/' . $customerId)->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function getOrdersData(): array
    {
        $response = $this->guzzle->get('orders');
        return $this->handleResponse($response)['data'];
    }

    public function getOrderDataById(int $orderId): array
    {
        $response = $this->guzzle->get('orders/' . $orderId);
        return $this->handleResponse($response)['data'];
    }

    public function postOrderData(ArrayHash $data): array
    {
        $contents = $this->guzzle->post('orders', [
            'json' => $data
        ])->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function deleteOrderData(int $orderId): array
    {
        $contents = $this->guzzle->delete('orders/' . $orderId)->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function getOrdersDataByCustomerId(int $customerId): array
    {
        $response = $this->guzzle->get('customers/' . $customerId . '/orders');
        return $this->handleResponse($response)['data'] ?? [];
    }

    public function getProductsData(): array
    {
        $response = $this->guzzle->get('products');
        return $this->handleResponse($response)['data'];
    }

    public function getProductDataById(int $productId): array
    {
        $response = $this->guzzle->get('products/' . $productId);
        return $this->handleResponse($response)['data'];
    }

    public function postProductData(ArrayHash $data): array
    {
        $contents = $this->guzzle->post('products', [
            'json' => $data
        ])->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function putProductData(int $productId, ArrayHash $data): array
    {
        $contents = $this->guzzle->put('products/' . $productId, [
            'json' => $data
        ])->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }

    public function deleteProductData(int $productId): array
    {
        $contents = $this->guzzle->delete('products/' . $productId)->getBody()->getContents();

        return Json::decode($contents, Json::FORCE_ARRAY);
    }
}