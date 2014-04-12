<?php
namespace Application\User\Modules\Register;

use \Library\Entities\User;

class RegisterControleur extends \Library\Controleur{

	use \Library\Validator;

	public function run(){
		if(isset($_POST['add'])){
			$userManager = $this->getManagerof("User");
			if(!isset($_POST['login']) || !$this->isValidString($_POST['login'])){
				$txt = "Erreur dans le login";
			}else if($userManager->exist($_POST['login']) != 0){
				$txt = "Ce login existe déjà";
			}else if(!isset($_POST['email']) || !$this->isValidMail($_POST['email'])){
				$txt = "Erreur dans votre email";
			}else if(!isset($_POST['mdp']) || empty($_POST['mdp']) || !isset($_POST['mdpv']) || empty($_POST['mdpv']) || $_POST['mdp'] !== $_POST['mdpv']){
				$txt = "Les mots de passe ne correspondent pas";
			}else if(!isset($_POST['avatar']) || !$this->isValidURL($_POST['avatar'])){
				$txt = "Problème d'avatar";
			}else{
				$user = new User(array(
					'id'=> 0,
					'name' => $this->toString($_POST['login']),
					'email' => $this->toString($_POST['email']),
					'password' => sha1($_POST['mdp']),
					'avatar' => $this->toString($_POST['avatar']),
					'statut' => 0
					));
				$this->getManagerof("User")->add($user);
				$txt ='Votre enregistrement a bien été pris en compte. Vous recevrez bientôt un mail vous confirmant l\'acccès aux photos privée <a href="/">Retour accueil</a>';
			}
			$this->_app->getPage()->setVars('txt', $txt);
		}
	}
}