<?php

namespace Application\User\Modules\Deconnexion;

class DeconnexionControleur extends \Library\Controleur{

	public function run(){
		$this->_app->getUser()->deconnexion();
		$this->_app->getHTTPResponse()->redirect("/");
	}
}