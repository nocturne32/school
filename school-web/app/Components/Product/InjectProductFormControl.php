<?php declare(strict_types = 1);

namespace App\Components\Product;

trait InjectProductFormControl
{

    protected ProductFormControlFactory $productFormControlFactory;

    public function injectProductFormControlFactory(ProductFormControlFactory $productFormControlFactory): void
    {
        $this->productFormControlFactory = $productFormControlFactory;
    }

    protected function createComponentProductFormControl(): ProductFormControl
    {
        $id = (int) $this->getParameter('id');

        return $this->productFormControlFactory->create($id);
    }

    public function getProductFormControl(): ProductFormControl
    {
        return $this->getComponent(ProductFormControl::COMPONENT_NAME);
    }

}
