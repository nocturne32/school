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
            $this->flashMessage($e->getMessage(), 'alert-warning');
        }

        $this->redirect('this');
    }
}
