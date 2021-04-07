<?php declare(strict_types=1);

namespace App\Controller;

use App\Facade\OrderListFacade;
use Symfony\Component\HttpFoundation\Response;

class OrderListController extends AbstractApiController
{
    public function indexAction(
        OrderListFacade $orderListFacade
    ): Response {

        $orders = $orderListFacade->findAll();

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => 'Order list',
            'data' => $orders
        ]);
    }

}
