<?php declare(strict_types = 1);

namespace App\Components\Product;

interface ProductFormControlFactory
{

    public function create(?int $productId = null): ProductFormControl;

}
