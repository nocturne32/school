<?php declare(strict_types = 1);

namespace App\Components\Order;

interface OrderFormControlFactory
{

    public function create(): OrderFormControl;

}
