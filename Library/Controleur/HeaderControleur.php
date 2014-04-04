<?php
namespace Library\Controleur;

class HeaderControleur extends \Library\Controleur{

	public function run(){
		if(($connecting = $this->_app->getUser()->isConnected())){
			$name = $this->_app->getUser()->get('user')->getName();
			$avatar = $this->_app->getUser()->get('user')->getAvatar();
			$this->_app->getPage()->setVars('name', $name);
			$this->_app->getPage()->setVars('avatar', $avatar);
		}
		$this->_app->getPage()->setVars('connecting', $connecting);

		$admin = ($this->_app->getUser()->isAdmin()) ? true : false;
		$this->_app->getPage()->setVars('isAdmin', $admin);
	}
}