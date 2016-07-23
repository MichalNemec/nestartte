<?php
/**
 * Created by PhpStorm.
 * User: nexen
 * Date: 18.11.15
 * Time: 16:29
 */

namespace App\Presenters;

class SecuredPresenter extends BasePresenter
{

    public function startup($url = NULL)
	{
		parent::startup();

		if (!$this->getUser()->isLoggedIn()) {
			$this->redirect(':Homepage:default');
		}
	}

}