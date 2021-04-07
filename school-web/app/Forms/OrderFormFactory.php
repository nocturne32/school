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
        $form->addText('firstname', 'Firstname')
            ->setRequired();
        $form->addText('lastname', 'Lastname')
            ->setRequired();
        $form->addCheckboxList('products', 'Products')
            ->setRequired();

        $form->addSubmit('submit', 'Order');

        return $form;
    }

}
