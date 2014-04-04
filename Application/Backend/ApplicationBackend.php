<?php
namespace Application\Backend;

class ApplicationBackend extends \Library\Application{
	protected $_mail,
		$_name,
		$_User;

	public function __construct(){
		parent::__construct();
		$this->_name = 'Backend';
		$this->_mail = new \Library\MailSender();

	}

	public function run(){

		// INSTANCIATION DU ROUTER
		$Router = new \Library\Router();
		
		//RECHERCHE D'UNE ROUTE
		if(($route = $Router->get($_SERVER['REQUEST_URI'])) === false){
			$this->getHTTPResponse()->error();
		}	

		//On teste si l'utilisateur est un admin
		if($this->getUser()->isAdmin()){
			// INSTANCIATION DU CONTROLEUR
			$controleurPath = 'Application\\'.$this->_name.'\\Modules\\'.$route->getModule().'\\'.$route->getModule().'Controleur';
			$controlleur = new $controleurPath($this, $route->getMatches());
			$controlleur->run();

			// GESTION UTILISATEUR 
			$name = $this->getUser()->get('user')->getName();
			$avatar = $this->getUser()->get('user')->getAvatar();
			$this->getPage()->setVars('name', $name);
			$this->getPage()->setVars('avatar', $avatar);

			//Récupèration de la vue associé au controleur
			$this->_page->setView('..\\Application\\'.$this->_name.'\\Modules\\'.$route->getModule().'\\view.php');
			
			//On Appelle le controleur pour le menu du gauche
			$NavControleur = new \Library\Controleur\NavControleur($this, $route->getMatches());
			$NavControleur->run();

			//Envoi de la page généré
			exit($this->_page->getPage());
		}else{
			$this->getHTTPResponse()->error();
		}	
	}
	
	public function getMail(){
		return $this->_mail;
	}

}