<?php

declare(strict_types=1);

namespace App\Modules\Front\Presenters;

use App\Api\ApiClient;
use App\Components\Order\InjectOrderFormControl;
use Nette;
use Nextras\Application\UI\SecuredLinksPresenterTrait;


abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    use SecuredLinksPresenterTrait;
}
