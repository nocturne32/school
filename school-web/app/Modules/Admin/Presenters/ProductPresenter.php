<?php

declare(strict_types=1);

namespace App\Modules\Admin\Presenters;

use App\Api\ApiClient;
use App\Components\Product\InjectProductFormControl;
use App\Model\ProductFacade;
use GuzzleHttp\Exception\ClientException;
use Nette;
use Nette\Application\Responses\JsonResponse;
use Psr\Http\Message\ResponseInterface;


final class ProductPresenter extends BasePresenter
{
    use InjectProductFormControl;

    /** @var ProductFacade @inject */
    public ProductFacade $productFacade;

    public function actionDefault(int $id): void
    {
        try {
            $product = $this->productFacade->getProductById($id);
            $this->template->product = $product;

        } catch (ClientException $e) {
            $this->error('Page not found');
        }
    }

    public function actionEdit(int $id): void
    {
        try {
            $product = $this->productFacade->getProductById($id);
            $this->template->product = $product;

        } catch (ClientException $e) {
            $this->error('Page Not Found');
        }
    }

    public function actionCreate(): void
    {

    }

}
