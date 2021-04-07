<?php declare(strict_types=1);


namespace App\Model;


use App\Api\ApiClient;
use DusanKasan\Knapsack\Collection;
use Nette\Utils\ArrayHash;

class ProductListFacade
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function findProducts(): ArrayHash
    {
        return ArrayHash::from($this->client->getProducts()->getAll());
    }

    public function findProductsAsPairs(): array
    {
        return Collection::from($this->client->getProducts()->getAll())
            ->mapcat(function ($product) {
                return [$product['id'] => $product['name'] . ' - ' . $product['price'] . ' CZK'];
            })
            ->toArray();
    }

}