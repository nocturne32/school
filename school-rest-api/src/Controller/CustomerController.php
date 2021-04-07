<?php declare(strict_types=1);

namespace App\Controller;

use App\Exception\CustomerCreateFailedException;
use App\Exception\CustomerDeleteFailedException;
use App\Exception\CustomerUpdateFailedException;
use App\Facade\CustomerFacade;
use App\Facade\OrderListFacade;
use JsonException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends AbstractApiController
{

    public function indexAction(
        Request $request,
        CustomerFacade $customerFacade
    ): Response {

        $customerId = (int)$request->get('id');
        $customer = $customerFacade->getById($customerId);

        if (!$customer) {
            return $this->handleResponse([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'Customer not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => 'Customer detail',
            'data' => $customer
        ]);
    }

    public function createAction(Request $request, CustomerFacade $customerFacade): Response
    {
        try {
            $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $customer = $customerFacade->create($data);

        } catch (CustomerCreateFailedException|JsonException $e) {
            return $this->handleResponse([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => sprintf('Customer with email %s created', $customer->getEmail())
        ]);
    }

    public function updateAction(Request $request, CustomerFacade $customerFacade): Response
    {
        try {
            $customerId = (int)$request->get('id');
            $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $customer = $customerFacade->update($customerId, $data);

        } catch (CustomerUpdateFailedException|JsonException $e) {
            return $this->handleResponse([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => sprintf('Customer with id %d updated', $customerId)
        ]);
    }

    public function deleteAction(Request $request, CustomerFacade $customerFacade): Response
    {
        try {
            $customerId = (int)$request->get('id');
            $isDeleted = $customerFacade->delete($customerId);

            if (!$isDeleted) {
                return $this->handleResponse([
                    'code' => Response::HTTP_NOT_FOUND,
                    'message' => 'Customer not found'
                ], Response::HTTP_NOT_FOUND);
            }

        } catch (CustomerDeleteFailedException $e) {
            return $this->handleResponse([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => sprintf('Customer with id %d deleted', $customerId)
        ]);
    }

    public function ordersAction(
        Request $request,
        CustomerFacade $customerFacade,
        OrderListFacade $orderListFacade
    ): Response {

        $customerId = (int)$request->get('id');
        $customer = $customerFacade->getById($customerId);

        if (!$customer) {
            return $this->handleResponse([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'Customer does not exist'
            ], Response::HTTP_NOT_FOUND);
        }

        $orders = $orderListFacade->findByCustomerId($customerId);

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => "Customer order list",
            'data' => [
                'customer' => $customer,
                'orders' => $orders
            ]
        ], Response::HTTP_OK);
    }
}
