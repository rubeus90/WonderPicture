<?php
namespace Application\User;

class ApplicationConnexion extends \Library\Application{
	protected $_name,
		$_User;

	public function __construct(){
		parent::__construct();
		$this->_name = 'User';
		$this->_User =  new \Library\User();
	}

	public function run(){
		
		// INSTANCIATION DU ROUTER
		$Router = new \Library\Router();

		//RECHERCHE D'UNE ROUTE
		if(($route = $Router->get($_SERVER['REQUEST_URI'])) === false || $route->getApplication() != $this->_name){
			$this->getHTTPResponse()->error();
		}	

		// INSTANCIATION DU CONTROLEUR
		$controleurPath = 'Application\\'.$this->_name.'\\Modules\\'.$route->getModule().'\\'.$route->getModule().'Controleur';
		$controlleur = new $controleurPath($this, $route->getMatches());
		$controlleur->run();

		// VUE CONTROLEUR
		$this->_page->setView('..\\Application\\'.$this->_name.'\\Modules\\'.$route->getModule().'\\view.php');

		// ENVOI DE LA PAGE
		exit($this->_page->getPage());
	}

	public function getUser(){
		return $this->_User;
	}
}