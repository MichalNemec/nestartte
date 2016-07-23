<?php

namespace App\Presenters;

use App\Components\Menu\Menu;
use Nette;
use App\Model;
use Kdyby;
use App\Forms;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

    use Kdyby\Autowired\AutowireProperties;
    use Kdyby\Autowired\AutowireComponentFactories;

    /** @var Forms\SignInFormFactory @inject */
    public $signInFactory;

    /** @var Forms\SignUpFormFactory @inject */
    public $signUpFactory;


    protected function createComponentMenu($name)
    {
        $menu = new Menu($this->user, $this->signInFactory, $this->signUpFactory);
        return $menu;
    }

}
