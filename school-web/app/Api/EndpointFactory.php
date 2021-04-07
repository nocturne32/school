<?php declare(strict_types=1);


namespace App\Api;


use App\Api\Endpoints\CustomersEndpoint;
use App\Api\Endpoints\OrdersEndpoint;
use App\Api\Endpoints\ProductsEndpoint;
use Contributte\Guzzlette\ClientFactory;

class EndpointFactory
{
    public function createCustomers(string $baseUri, ClientFactory $clientFactory): CustomersEndpoint
    {
        return new CustomersEndpoint($baseUri, $clientFactory);
    }

    public function createOrders(string $baseUri, ClientFactory $clientFactory): OrdersEndpoint
    {
        return new OrdersEndpoint($baseUri, $clientFactory);
    }

    public function createProducts(string $baseUri, ClientFactory $clientFactory): ProductsEndpoint
    {
        return new ProductsEndpoint($baseUri, $clientFactory);
    }
}