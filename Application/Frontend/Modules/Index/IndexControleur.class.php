<?php

namespace Application\Frontend\Modules\Index;


class IndexControleur extends \Library\Controleur {
	
	public function run(){
	
		//DONNEES
		$nombrePhoto = 5;
		
		//RECUPERATION MANAGER
		$managerPhoto = $this->getManagerof('Photo');
		
		//CREATION DES DONNEES DE LA VIEWS
		$listeDernierePhoto = $managerPhoto->obtenirListe(0,$nombrePhoto);
		
		
		//ATTRIBUTION DES VARIABLES
		$page = $this->_app->getPage();
		$page->setVars('test','COUCOU');
		$page->setVars('listeDernierePhoto',$listeDernierePhoto);
		
	}
}