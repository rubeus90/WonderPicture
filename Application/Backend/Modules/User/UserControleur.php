<?php
namespace Application\Backend\Modules\User;


class UserControleur extends \Library\Controleur {
	private $_userManager;
	
	public function run(){
		$this->_userManager = $this->getManagerof('User');

		if(isset($_POST['accept'])){
			$this->accept();
		}else if(isset($_POST['banish'])){
			$this->banish();
		}else if(isset($_POST['refuse'])){
			$this->refuse();
		}

		$users = $this->_userManager->getAll();

		$this->_app->getPage()->setVars('users', $users);
		$this->_app->getPage()->setVars('title', '- Utilisateur');
	}

	private function accept(){
		$mail = $this->_app->getMail();
		$subject = "Compte PicShow";
		$msg = "Nous avons le plaisir de vous anoncer que votre compte a correctement été enregistré. Vous pouvez maintenant accéder à un contenu exclusif.";
		$user = $this->_userManager->get($_POST['id']);

		//$mail->notify($user,$subject,$msg);

		$user->setStatut(1);
		$this->_userManager->update($user);
	}

	private function banish(){
		//On envoi une notification à l'utilisateur
		$mail = $this->_app->getMail();
		$subject = "Bannissement PicShow";
		$msg = "Nous avons le regret de vous anoncer que votre compte a été banni de PicShow. Merci de votre compréhension.";
		$user = $this->_userManager->get($_POST['id']);

		//$mail->notify($user,$subject,$msg);

		$user = $this->_userManager->delete($_POST['id']);
	}

	private function refuse(){
		$user = $this->_userManager->delete($_POST['id']);
	}
}