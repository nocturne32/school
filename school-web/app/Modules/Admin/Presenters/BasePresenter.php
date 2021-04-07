<?php

declare(strict_types=1);

namespace App\Modules\Admin\Presenters;

use App\Api\ApiClient;
use Nette;
use Nextras\Application\UI\SecuredLinksPresenterTrait;


abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    use SecuredLinksPresenterTrait;

}
