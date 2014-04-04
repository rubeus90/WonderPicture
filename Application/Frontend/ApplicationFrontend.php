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

		//RECHERCHE D'UNE ROUTE
		if(($route = $Router->get($_SERVER['REQUEST_URI'])) === false || $route->getApplication() != $this->_name){
			$this->getHTTPResponse()->error();
		}	

		// INSTANCIATION DU CONTROLEUR PRINCIPALE
		$controleurPath = 'Application\\'.$this->_name.'\\Modules\\'.$route->getModule().'\\'.$route->getModule().'Controleur';
		$controlleur = new $controleurPath($this, $route->getMatches());
		$controlleur->run();

		//VUE CONTROLEUR
		$this->_page->setView('..\\Application\\'.$this->_name.'\\Modules\\'.$route->getModule().'\\view.php');
		
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

		
		// INSTANCIATION CONTROLEUR MENU
		$NavControleur = new \Library\Controleur\NavControleur($this, $route->getMatches());
		$NavControleur->run();
		
		// ENVOI DE LA PAGE
		exit($this->_HTTPResponse->send($this->_page->getPage()));
	}
}