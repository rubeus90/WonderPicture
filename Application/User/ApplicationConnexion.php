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
		$route = $Router->get($_SERVER['REQUEST_URI']);	

		// INSTANCIATION DU CONTROLEUR
		$controleurPath = 'Application\\'.$this->_name.'\\Modules\\'.$route->getModule().'\\'.$route->getModule().'Controleur';
		$controlleur = new $controleurPath($this, $route->getMatches());
		$controlleur->run();

		//Récupèration de la vue associé au controleur
		$this->_page->setView('..\\Application\\'.$this->_name.'\\Modules\\'.$route->getModule().'\\view.php');

		//Envoi de la page généré
		exit($this->_page->getPage());
	}

	public function getUser(){
		return $this->_User;
	}
}