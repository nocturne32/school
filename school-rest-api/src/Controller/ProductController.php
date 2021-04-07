<?php declare(strict_types=1);

namespace App\Controller;

use App\Exception\ProductDeleteFailedException;
use App\Exception\ProductUpdateFailedException;
use App\Exception\ProductCreateFailedException;
use App\Facade\ProductFacade;
use JsonException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractApiController
{
    public function indexAction(
        Request $request,
        ProductFacade $productFacade
    ): Response {

        $productId = (int)$request->get('id');
        $product = $productFacade->getById($productId);

        if (!$product) {
            return $this->handleResponse([
                'code' => Response::HTTP_NOT_FOUND,
                'message' => 'Product not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => 'Product detail',
            'data' => $product
        ]);
    }
    
    public function createAction(Request $request, ProductFacade $productFacade): Response
    {
        try {
            $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $product = $productFacade->create($data);

        } catch (ProductCreateFailedException  $e) {
            return $this->handleResponse([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->handleResponse([
            'code' => Response::HTTP_CREATED,
            'message' => sprintf('Product with id %d created', $product->getId())
        ], Response::HTTP_CREATED);
    }


    public function updateAction(Request $request, ProductFacade $productFacade): Response
    {
        try {
            $productId = (int)$request->get('id');
            $data = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
            $product = $productFacade->update($productId, $data);

        } catch (ProductUpdateFailedException|JsonException $e) {
            return $this->handleResponse([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => sprintf('Product with id %d updated', $productId)
        ]);
    }

    public function deleteAction(Request $request, ProductFacade $productFacade): Response
    {
        try {
            $productId = (int)$request->get('id');
            $isDeleted = $productFacade->delete($productId);

        } catch (ProductDeleteFailedException $e) {
            return $this->handleResponse([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => sprintf('Product with id %d deleted', $productId)
        ]);
    }

}
