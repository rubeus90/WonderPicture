<?php
namespace Application\Utilisateur;

class ApplicationUtilisateur extends \Library\Application{
	protected $_name;

	public function __construct(){
		parent::__construct();
		$this->_name = 'Utilisateur';
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
		$this->_page->setView('../Application/'.$this->_name.'/Modules/'.$route->getModule().'/view.php');
				
		
		//Envoi de la page généré
		exit($this->_HTTPResponse->send($this->_page->getPage()));
	}
}