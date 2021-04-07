<?php declare(strict_types=1);

namespace App\Components\Order;

use App\Components\BaseControl;
use App\Forms\OrderFormFactory;
use App\Model\CustomerFacade;
use App\Model\OrderFacade;
use App\Model\ProductListFacade;
use App\Modules\Admin\Presenters\ProductListPresenter;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\MultiChoiceControl;
use Nette\Forms\Controls\SelectBox;
use Nette\Utils\ArrayHash;

class OrderFormControl extends BaseControl
{

    public const COMPONENT_NAME = 'orderFormControl';

    private ?int $orderId;

    private OrderFormFactory $orderFormFactory;

    private OrderFacade $orderFacade;

    private CustomerFacade $customerFacade;

    private ProductListFacade $productListFacade;

    public function __construct(
        OrderFormFactory $orderFormFactory,
        OrderFacade $orderFacade,
        CustomerFacade $customerListFacade,
        ProductListFacade $productListFacade
    ) {
        $this->orderFormFactory = $orderFormFactory;
        $this->orderFacade = $orderFacade;
        $this->customerFacade = $customerListFacade;
        $this->productListFacade = $productListFacade;
    }


    public function render(): void
    {
        $this->template->_shared = __DIR__ . '/../@shared/forms.latte';
        $this->template->setFile(__DIR__ . '/templates/form.latte');
        $this->template->render();
    }

    public function createComponentForm(): Form
    {
        $form = $this->orderFormFactory->create();

        /** @var MultiChoiceControl $products */
        $products = $form['products'];
        $products->setItems($this->productListFacade->findProductsAsPairs());

        $form->onSuccess[] = function (Form $form, ArrayHash $values): void {
            $customer = ArrayHash::from([
                'email' => $values->email,
                'firstname' => $values->firstname,
                'lastname' => $values->lastname,
                'street' => $values->street,
                'city' => $values->city,
                'postal_code' => $values->postal_code
            ]);

            $customer = $this->customerFacade->createOrUpdateCustomer($customer);

            $order = ArrayHash::from([
                'customer' => $customer->id,
                'products' => $values->products,
            ]);

            $this->orderFacade->createOrder($order);

            $this->presenter->flashMessage('Order placed!', 'alert-success');
            $this->resolveRedirect();
        };

        return $form;
    }

    protected function resolveRedirect(): void
    {
        $this->presenter->redirect('this');
    }

}
