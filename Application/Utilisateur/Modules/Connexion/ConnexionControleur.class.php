<?php
namespace Application\Utilisateur\Modules\Connexion;


class ConnexionControleur extends \Library\Controleur {
	use \Library\Validator;
	
	public function run(){
		$managerUtilisateur = $this->getManagerOf('Utilisateur');

		if(isset($_POST['login']) && isset($_POST['mdp']) && exist($_POST['login']) && exist($_POST['mdp'])){
			$login = toString($_POST['login']);
			$mdp = toString($_POST['mdp']);
			if($user = testUtilisateur($login,$mdp)){
				$this->_app->getUser()->Connexion($user);
				if($user->getEstAdmin()){
					$this->_app->getUser()->setAdmin(true);
					$this->_app->getHTTPResponse()->redirect("/Admin");
				}
				else{
					$this->_app->getHTTPResponse()->redirect("/");
				}
			}
			else{
				$this->_app->getPage()->setVars('text', "Identifiant ou Mot de passe incorrect");
			}
		}
		else{
			$this->_app->getPage()->setVars('text', "Identifiant ou Mot de passe incorrect");
		}

	}
}
