<?php declare(strict_types=1);

namespace App\Forms;

use Nette\Application\UI\Form;
use Nette\SmartObject;

class ProductFormFactory
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

        $form->addText('code', 'Code')
            ->setRequired()
            ->addRule(Form::PATTERN,
                'Please use lowercase alphanumeric characters (a-z, 0-9) with optional underscore',
                '^[a-z0-9_]*$')
            ->setOption('description',
                'Code for identification, please use lowercase alphanumeric characters with optional underscore');
        $form->addText('name', 'Name')
            ->setRequired()
            ->setOption('description', 'Name of the product');
        $form->addText('price', 'Price')
            ->setRequired()
            ->setHtmlAttribute('min', '0')
            ->addRule(Form::INTEGER, 'Enter a number.')
            ->setOption('description', 'Number, eg: 100');
        $form->addTextArea('description', 'Description');

        $form->addSubmit('submit', 'Save');

        return $form;
    }

}
