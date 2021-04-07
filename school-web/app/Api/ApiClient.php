<?php declare(strict_types=1);


namespace App\Api;


use App\Api\Endpoints\CustomersEndpoint;
use App\Api\Endpoints\OrdersEndpoint;
use App\Api\Endpoints\ProductsEndpoint;
use Contributte\Guzzlette\ClientFactory;


class ApiClient
{
    private CustomersEndpoint $customers;

    private OrdersEndpoint $orders;

    private ProductsEndpoint $products;

    public function __construct(string $baseUri, ClientFactory $clientFactory, EndpointFactory $endpointFactory)
    {
        $this->customers = $endpointFactory->createCustomers($baseUri, $clientFactory);
        $this->orders = $endpointFactory->createOrders($baseUri, $clientFactory);
        $this->products = $endpointFactory->createProducts($baseUri, $clientFactory);
    }

    public function getCustomers(): CustomersEndpoint
    {
        return $this->customers;
    }

    public function getOrders(): OrdersEndpoint
    {
        return $this->orders;
    }

    public function getProducts(): ProductsEndpoint
    {
        return $this->products;
    }

}