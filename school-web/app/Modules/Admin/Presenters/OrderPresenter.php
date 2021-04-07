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
            $this->error('Page not found');
        }
    }

    /**
     * @secured
     * @param int $orderId
     * @param bool $isPaid
     * @throws Nette\Application\AbortException
     */
    public function handleMarkAsPaid(int $orderId, bool $isPaid = true): void
    {
        try {
            if ($isPaid) {
                $this->orderFacade->markAsPaid($orderId);
                $this->flashMessage('Order marked as paid', 'alert-success');
            } else {
                $this->orderFacade->markAsUnpaid($orderId);
                $this->flashMessage('Order marked as unpaid', 'alert-warning');
            }
        } catch (ClientException $e) {
            $this->flashMessage($e->getMessage(), 'alert-danger');
        }

        $this->redirect('this');
    }

}
