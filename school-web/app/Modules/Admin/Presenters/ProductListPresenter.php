<?php

declare(strict_types=1);

namespace App\Modules\Admin\Presenters;

use App\Api\ApiClient;
use App\Model\ProductFacade;
use App\Model\ProductListFacade;
use GuzzleHttp\Exception\ClientException;
use Nette;
use Nette\Application\Responses\JsonResponse;
use Psr\Http\Message\ResponseInterface;


final class ProductListPresenter extends BasePresenter
{
    /** @var ProductListFacade @inject */
    public ProductListFacade $productListFacade;

    /** @var ProductFacade @inject */
    public ProductFacade $productFacade;

    public function actionDefault(): void
    {
        try {
            $this->template->products = $this->productListFacade->findProducts();
        } catch (ClientException $e) {
            $this->error('Page not found');
        }
    }

    /**
     * @secured
     * @param int $productId
     */
    public function handleDeleteProduct(int $productId): void
    {
        try {
            $this->productFacade->deleteById($productId);
            $this->flashMessage('Product deleted', 'alert-warning');

        } catch (ClientException $e) {
            $this->flashMessage($e->getMessage(), 'alert-danger');
        }

        $this->redirect('this');
    }

}
