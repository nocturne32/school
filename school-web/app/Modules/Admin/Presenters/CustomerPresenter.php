<?php

declare(strict_types=1);

namespace App\Modules\Admin\Presenters;

use App\Api\ApiClient;
use App\Model\CustomerFacade;
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
        $this->flashMessage('Order deleted', 'alert-warning');
        $this->redirect('this');
    }

}
