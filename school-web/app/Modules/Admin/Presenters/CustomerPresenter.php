<?php

declare(strict_types=1);

namespace App\Modules\Admin\Presenters;

use App\Api\ApiClient;
use App\Model\CustomerFacade;
use App\Model\OrderFacade;
use App\Model\OrderListFacade;
use GuzzleHttp\Exception\ClientException;
use Nette;
use Nette\Application\Responses\JsonResponse;
use Psr\Http\Message\ResponseInterface;


final class CustomerPresenter extends BasePresenter
{
    /** @var CustomerFacade @inject */
    public CustomerFacade $customerFacade;

    /** @var OrderListFacade @inject */
    public OrderListFacade $orderListFacade;
    
    /** @var OrderFacade @inject */
    public OrderFacade $orderFacade;

    public function actionDefault(int $id): void
    {
        try {
            $customer = $this->customerFacade->getCustomerById($id);
            $customerOrders = $this->orderListFacade->findCustomerOrdersById($id);

            $this->template->customer = $customer;
            $this->template->orders = $customerOrders->orders;
        } catch (ClientException $e) {
            $this->error('Page Not Found');
        }

    }

    /**
     * @secured
     * @param int $orderId
     */
    public function handleDeleteOrder(int $orderId): void
    {
        try {
            $this->orderFacade->deleteById($orderId);
            $this->flashMessage('Order deleted', 'alert-warning');

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
