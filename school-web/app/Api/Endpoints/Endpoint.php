<?php declare(strict_types=1);


namespace App\Api\Endpoints;


use Nette\Utils\ArrayHash;

interface Endpoint
{
    public function getAll(): array;

    public function get(int $id): array;

    public function post(ArrayHash $data): array;

    public function put(int $id, ArrayHash $data): array;

    public function delete(int $id): array;
}