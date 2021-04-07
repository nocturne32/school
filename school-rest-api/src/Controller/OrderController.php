<?php declare(strict_types=1);

namespace App\Controller;

use App\Exception\OrderDeleteFailedException;
use App\Exception\OrderUpdateFailedException;
use App\Exception\OrderCreateFailedException;
use App\Facade\OrderFacade;
use JsonException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends AbstractApiController
{
    public function indexAction(
        Request $request,
        OrderFacade $orderFacade
    ): Response {

        $orderId = (int)$request->get('id');
        $order = $orderFacade->getById($orderId);

        if (!$order) {
            return $this->handleResponse([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'Order not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => 'Order detail',
            'data' => $order
        ]);
    }

    public function createAction(Request $request, OrderFacade $orderFacade): Response
    {
        try {
            $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $order = $orderFacade->create($data);

        } catch (OrderCreateFailedException|JsonException  $e) {
            return $this->handleResponse([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->handleResponse([
            'code' => Response::HTTP_CREATED,
            'message' => sprintf('Order with id %d created', $order->getId())
        ], Response::HTTP_CREATED);
    }


    public function updateAction(Request $request, OrderFacade $orderFacade): Response
    {
        try {
            $orderId = (int)$request->get('id');
            $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $order = $orderFacade->update($orderId, $data);

        } catch (OrderUpdateFailedException|JsonException $e) {
            return $this->handleResponse([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => sprintf('Order with id %d updated', $orderId)
        ]);
    }

    public function deleteAction(Request $request, OrderFacade $orderFacade): Response
    {
        try {
            $orderId = (int)$request->get('id');
            $isDeleted = $orderFacade->delete($orderId);

        } catch (OrderDeleteFailedException $e) {
            return $this->handleResponse([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => sprintf('Order with id %d deleted', $orderId)
        ]);
    }
}
