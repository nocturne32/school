<?php declare(strict_types=1);

namespace App\Controller;

use App\Facade\ProductListFacade;
use Symfony\Component\HttpFoundation\Response;

class ProductListController extends AbstractApiController
{
    public function indexAction(
        ProductListFacade $productListFacade
    ): Response
    {
        $products = $productListFacade->findAll();

        return $this->handleResponse([
            'code' => Response::HTTP_OK,
            'message' => 'Product list',
            'data' => $products,
        ]);
    }
}
