<?php

declare(strict_types=1);

namespace App\Modules\Admin\Presenters;

use App\Api\ApiClient;
use App\Model\OrderFacade;
use GuzzleHttp\Exception\ClientException;
use Nette;
use Nette\Application\Responses\JsonResponse;
use Psr\Http\Message\ResponseInterface;


final class OrderPresenter extends BasePresenter
{
    /** @var OrderFacade @inject */
    public OrderFacade $orderFacade;

    public function actionDefault(int $id): void
    {
        try {
            $order = $this->orderFacade->findOrderById($id);
            $this->template->order = $order;
            $this->template->customer = $order->customer;
            $this->template->products = $order->products;

        } catch (ClientException $e) {
            $this->error('Page Not Found');
        }
    }

}
