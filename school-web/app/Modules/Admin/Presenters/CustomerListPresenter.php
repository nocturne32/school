<?php

declare(strict_types=1);

namespace App\Modules\Admin\Presenters;

use App\Api\ApiClient;
use App\Model\CustomerFacade;
use App\Model\CustomerListFacade;
use GuzzleHttp\Exception\ClientException;
use Nette;
use Nette\Application\Responses\JsonResponse;
use Psr\Http\Message\ResponseInterface;


final class CustomerListPresenter extends BasePresenter
{
    /** @var CustomerListFacade @inject */
    public CustomerListFacade $customerListFacade;

    /** @var CustomerFacade @inject */
    public CustomerFacade $customerFacade;

    public function actionDefault(): void
    {
        try {
            $this->template->customers = $this->customerListFacade->findCustomers();
        } catch (ClientException $e) {
            $this->error('Page Not Found');
        }
    }

    /**
     * @secured
     * @param int $customerId
     */
    public function handleDeleteCustomer(int $customerId): void
    {
        try {
            $this->customerFacade->deleteById($customerId);
            $this->flashMessage('Customer deleted', 'alert-warning');

        } catch (ClientException $e) {
            $this->flashMessage($e->getMessage(), 'alert-danger');
        }

        $this->redirect('this');
    }


}
