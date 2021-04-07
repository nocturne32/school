<?php declare(strict_types=1);


namespace App\Api\Endpoints;


use Contributte\Guzzlette\ClientFactory;
use GuzzleHttp\Client;
use Nette\Utils\ArrayHash;
use Nette\Utils\Json;
use Psr\Http\Message\ResponseInterface;

abstract class BaseEndpoint implements Endpoint
{
    protected Client $client;

    public function __construct(string $baseUri, ClientFactory $clientFactory)
    {
        $this->client = $clientFactory->createClient([
            'base_uri' => $baseUri
        ]);
    }

    protected function handleResponse(ResponseInterface $response)
    {
        return Json::decode($response->getBody()->getContents(), Json::FORCE_ARRAY);
    }

}