<?php declare(strict_types=1);


namespace App\Model;


use App\Api\ApiClient;
use Nette\Utils\ArrayHash;

class ProductFacade
{
    protected ApiClient $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    public function createProduct(ArrayHash $product): array
    {
        return $this->client->postProductData($product);
    }

    public function updateProduct(int $productId, ArrayHash $product): array
    {
        return $this->client->putProductData($productId, $product);
    }

    public function getProductById(int $productId): ArrayHash
    {
        return ArrayHash::from($this->client->getProductDataById($productId));
    }

    public function deleteById(int $productId): array
    {
        return $this->client->deleteProductData($productId);
    }

}