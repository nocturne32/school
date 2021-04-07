<?php declare(strict_types=1);

namespace App\Components\Product;

use App\Components\BaseControl;
use App\Forms\ProductFormFactory;
use App\Model\CustomerFacade;
use App\Model\ProductFacade;
use App\Model\ProductListFacade;
use App\Modules\Admin\Presenters\ProductListPresenter;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\MultiChoiceControl;
use Nette\Forms\Controls\SelectBox;
use Nette\Utils\ArrayHash;

class ProductFormControl extends BaseControl
{

    public const COMPONENT_NAME = 'productFormControl';

    private ?int $productId;

    private ProductFormFactory $productFormFactory;

    private ProductFacade $productFacade;

    public function __construct(
        ?int $productId,
        ProductFormFactory $productFormFactory,
        ProductFacade $productFacade
    ) {
        $this->productId = $productId;
        $this->productFormFactory = $productFormFactory;
        $this->productFacade = $productFacade;
    }


    public function render(): void
    {
        $this->template->_shared = __DIR__ . '/../@shared/forms.latte';
        $this->template->setFile(__DIR__ . '/templates/form.latte');
        $this->template->render();
    }

    public function renderEdit(): void
    {
        $id = $this->productId;

        if (!$id) {
            $this->error('Product could not be found');
        }

        $product = $this->productFacade->getProductById($id);

        if ($product) {
            $this['formEdit']->setDefaults($product);
        }

        $this->template->_shared = __DIR__ . '/../@shared/forms.latte';
        $this->template->setFile(__DIR__ . '/templates/form_edit.latte');
        $this->template->render();
    }

    public function createComponentForm(): Form
    {
        $form = $this->productFormFactory->create();

        $form->onSuccess[] = function (Form $form, ArrayHash $values): void {
            try {
                $this->productFacade->createProduct($values);

            } catch (ClientException $e) {
                $form->addError($e->getMessage());
                return;
            }

            $this->presenter->flashMessage('Product created!', 'alert-success');
            $this->resolveRedirect();
        };

        return $form;
    }

    public function createComponentFormEdit(): Form
    {
        $form = $this->productFormFactory->create();

        $form->onValidate[] = function (Form $form) {
            if (!$this->productId) {
                $form->addError('An error occurred');
            }
        };

        $form->onSuccess[] = function (Form $form, ArrayHash $values): void {
            try {
                $this->productFacade->updateProduct($this->productId, $values);

            } catch (ClientException $e) {
                $form->addError($e->getMessage());
                return;
            }

            $this->presenter->flashMessage('Product updated!', 'alert-success');
            $this->resolveRedirect();
        };

        return $form;
    }

    protected function resolveRedirect(): void
    {
        $this->presenter->redirect('this');
    }

}
