<?php

namespace Application\User\Modules\Profil;

class ProfilControleur extends \Library\Controleur{

	use \Library\Validator;

	private $_user;

	public function run(){

		if($this->_app->getUser()->isConnected()){
			$this->_user =  $this->_app->getUser()->get('user');
			$this->_app->getPage()->setVars('user', $this->_user);
			if(isset($_POST['update'])){
				$this->update();
			}

		}else{
			$this->_app->getHTTPResponse()->redirect("/");
		}
	}


	public function update(){

		if(isset($_POST['mdp']) && isset($_POST['mdpv']) && !empty($_POST['mdp']) && !empty($_POST['mdpv'])){
			if($_POST['mdp'] == $_POST['mdpv']){
				$this->_user->setPassword(sha1($_POST['mdp']));
				$this->_app->getPage()->setVars('txt', 'Votre profil a été mis à jour');
			}else{
				$this->_app->getPage()->setVars('txt', 'Les mots de passe ne coresspondent pas');
			}
		}
		
		if($this->isValidMail($_POST['email'])){
			$this->_user->setAvatar($_POST['email']);
			$this->_app->getPage()->setVars('txt', 'Votre profil a été mis à jour');
		}else if($this->exist($_POST['email'])){
			$this->_app->getPage()->setVars('txt', 'Erreur dans l\'Email');
		}

		if($this->isValidURL($_POST['avatar'])){
			$this->_user->setAvatar($_POST['avatar']);
			$this->_app->getPage()->setVars('txt', 'Votre profil a été mis à jour');
		}else if($this->exist($_POST['avatar'])){
			$this->_app->getPage()->setVars('txt', 'Erreur dans l\'URL');
		}
		
		$this->getManagerof('User')->update($this->_user);
	}
}