<?php declare(strict_types=1);

namespace App\Controller;

use App\Facade\CustomerListFacade;
use Symfony\Component\HttpFoundation\Response;

class CustomerListController extends AbstractApiController
{
    public function indexAction(
        CustomerListFacade $customerListFacade
    ): Response {

        $customers = $customerListFacade->findAll();

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => 'Customer list',
            'data' => $customers,
        ]);
    }
}
