<?php
namespace Application\Frontend;

class ApplicationFrontend extends \Library\Application{

	public function __construct(){
		parent::__construct();
		$this->_name = 'Frontend';
	}

	public function run(){

		// INSTANCIATION DU ROUTER
		$Router = new \Library\Router();
		$route = $Router->get($_SERVER['REQUEST_URI']);	

		// INSTANCIATION DU CONTROLEUR
		$controleurPath = 'Application\\'.$this->_name.'\\Modules\\'.$route->getModule().'\\'.$route->getModule().'Controleur';
		$controlleur = new $controleurPath($this, $route->getMatches());
		$controlleur->run();
		
		// GESTION UTILISATEUR 
		if(($connecting = $this->getUser()->isConnected())){
			$name = $this->getUser()->get('user')->getName();
			$avatar = $this->getUser()->get('user')->getAvatar();
			$this->getPage()->setVars('name', $name);
			$this->getPage()->setVars('avatar', $avatar);
		}
		$this->getPage()->setVars('connecting', $connecting);

		$admin = ($this->getUser()->isAdmin()) ? true : false;
		$this->getPage()->setVars('isAdmin', $admin);


		//Récupèration de la vue associé au controleur
		$this->_page->setView('..\\Application\\'.$this->_name.'\\Modules\\'.$route->getModule().'\\view.php');
				
		//On Construit le menu a gauche
		$controlleur->setNav();
		
		//Envoi de la page généré
		exit($this->_HTTPResponse->send($this->_page->getPage()));
	}
}