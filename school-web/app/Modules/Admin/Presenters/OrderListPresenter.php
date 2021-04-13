<?php

declare(strict_types=1);

namespace App\Modules\Admin\Presenters;

use App\Api\ApiClient;
use App\Model\OrderFacade;
use App\Model\OrderListFacade;
use GuzzleHttp\Exception\ClientException;
use Nette;
use Nette\Application\Responses\JsonResponse;
use Nette\Utils\ArrayHash;
use Psr\Http\Message\ResponseInterface;


final class OrderListPresenter extends BasePresenter
{

    /** @var OrderListFacade @inject */
    public OrderListFacade $orderListFacade;

    /** @var OrderFacade @inject */
    public OrderFacade $orderFacade;

    public function actionDefault(): void
    {
        try {
            $this->template->orders = $this->orderListFacade->findOrders();
        } catch (ClientException $e) {
            $this->error('Page not found');
        }
    }

    /**
     * @secured
     * @param int $orderId
     */
    public function handleDeleteOrder(int $orderId): void
    {
        try {
            $response = $this->orderFacade->deleteById($orderId);
            $this->flashMessage($response['message'], 'alert-warning');

        } catch (ClientException $e) {
            $this->flashMessage($e->getMessage(), 'alert-danger');
        }

        $this->redirect('this');
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
