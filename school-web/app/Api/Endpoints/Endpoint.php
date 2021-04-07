<?php declare(strict_types=1);


namespace App\Api\Endpoints;


use Nette\Utils\ArrayHash;

interface Endpoint
{
    public function getAll();

    public function get(int $id);

    public function post(ArrayHash $data);

    public function put(int $id, ArrayHash $data);

    public function delete(int $id);
}