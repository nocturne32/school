<?php declare(strict_types = 1);

namespace App\Components\Order;

trait InjectOrderFormControl
{

    protected OrderFormControlFactory $orderFormControlFactory;

    public function injectOrderFormControlFactory(OrderFormControlFactory $orderFormControlFactory): void
    {
        $this->orderFormControlFactory = $orderFormControlFactory;
    }

    protected function createComponentOrderFormControl(): OrderFormControl
    {
        return $this->orderFormControlFactory->create();
    }

    public function getOrderFormControl(): OrderFormControl
    {
        return $this->getComponent(OrderFormControl::COMPONENT_NAME);
    }

}
