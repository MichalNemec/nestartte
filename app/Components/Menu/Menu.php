<?php

namespace App\Components\Menu;

use App\Forms;
use Nette\Application\UI\Control;
use Nette\Security\User;

class Menu extends Control
{
    private $me;
    private $signInFactory;
    private $signUpFactory;

    public function __construct(
        User $me,
        Forms\SignInFormFactory $signInFactory,
        Forms\SignUpFormFactory $signUpFactory)
    {
        parent::__construct();
        $this->me = $me;
        $this->signInFactory = $signInFactory;
        $this->signUpFactory = $signUpFactory;
    }

    public function render()
    {
        $this->template->setFile(__COMP_DIR__ . '/Menu/menu.latte');
        if ($this->me->isLoggedIn()) {
            $this->template->amILoggedIn = true;
            $this->template->me = $this->me->identity;
        } else {
            $this->template->amILoggedIn = false;
        }
        $this->template->render();
    }

    /**
     * Sign-in form factory.
     * @return Nette\Application\UI\Form
     */
    protected function createComponentSignInForm()
    {
        return $this->signInFactory->create(function () {
            $this->redirect('this');
        });
    }


    /**
     * Sign-up form factory.
     * @return Nette\Application\UI\Form
     */
    protected function createComponentSignUpForm()
    {
        return $this->signUpFactory->create(function () {
            $this->redirect('this');
        });
    }


    public function handleLogout()
    {
        $this->presenter->getUser()->logout();
        $this->redirect("this");
    }


}