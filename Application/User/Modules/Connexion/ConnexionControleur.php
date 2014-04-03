<?php

namespace Application\User\Modules\Connexion;

class ConnexionControleur extends \Library\Controleur{

	public function run(){
		if(isset($_POST['connexion'])){
			$userManager = $this->getManagerof('User');

			if(isset($_POST['login']) && isset($_POST['mdp']) && !empty($_POST['login']) && !empty($_POST['mdp'])){
				$login = $_POST['login'];
				$mdp = sha1($_POST['mdp']);
				if(($id = $userManager->exist($login)) != 0){
					$user = $userManager->get($id); // Récupération utilisateur
					if($user->getPassword() === $mdp && $user->getStatut() > 0){
						$this->_app->getUser()->Connexion($user);

						//Cas administrateur
						if($user->getStatut() == 2){
							$this->_app->getUser()->setAdmin(true);
							$this->_app->getHTTPResponse()->redirect("/admin");
						}else{ //Membre
							$this->_app->getHTTPResponse()->redirect("/");
						}			
					}else{
						$this->_app->getPage()->setVars('txt', "Erreur dans les identifiants");
					}
				}else{
					$this->_app->getPage()->setVars('txt', "Erreur dans les identifiants");
				}
			}else{
				$this->_app->getPage()->setVars('txt', "Erreur dans les identifiants");
			}
		}
	}
}