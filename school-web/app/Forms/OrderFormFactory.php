<?php declare(strict_types = 1);

namespace App\Forms;

use Nette\Application\UI\Form;
use Nette\SmartObject;

class OrderFormFactory
{

    use SmartObject;

    private FormFactory $formFactory;

    public function __construct(FormFactory $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function create(): Form
    {
        $form = $this->formFactory->create();

        $form->addEmail('email', 'Email')
            ->setRequired();
        $form->addText('firstname', 'First name')
            ->setRequired();
        $form->addText('lastname', 'Last name')
            ->setRequired();
        $form->addText('street', 'Street')
            ->setRequired();
        $form->addText('city', 'City')
            ->setRequired();
        $form->addText('postal_code', 'Postal code')
            ->setRequired();
        $form->addCheckboxList('products', 'Products')
            ->setRequired('Choose at least one product');

        $form->addSubmit('submit', 'Order');

        return $form;
    }

}
