<?php

namespace Application\Frontend\Modules\Index;


class IndexControleur extends \Library\Controleur {
	
	public function run(){
	
		//PARAMETRES
		$nombrePhoto = 5;
		
		//RECUPERATION MANAGER
		$managerPhoto = $this->getManagerof('Photo');
		
		//CREATION DES DONNEES
		$listeDernierePhoto = $managerPhoto->obtenirListe(0,$nombrePhoto);
		
		
		//ATTRIBUTION DES VARIABLES
		$page = $this->_app->getPage();
		$page->setVars('test','COUCOU');
		$page->setVars('listeDernierePhoto',$listeDernierePhoto);
		
	}
}