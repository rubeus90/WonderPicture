<?php

namespace Application\Frontend\Modules\Index;

class IndexControleur extends \Library\Controleur {
	
	public function run(){
	
		
	
		//PARAMETRES
		$nombrePhoto = 5;
		
		//RECUPERATION MANAGER
		$managerPhoto = $this->getManagerof('Photo');
		
		//PORTION A SUPPRIMER QUAND LA BDD SERA COMPLETE
			$managerAlbum = $this->getManagerof('Album');
			$id = $managerAlbum->init();
			$managerPhoto->init($id);
			
		//FIN DE LA PORTION A SUPPRIMER
		
		//CREATION DES DONNEES
		$listeDernierePhoto = $managerPhoto->obtenirListe(0,$nombrePhoto);
		$listePhoto = $managerPhoto->obtenirListe(0,1,'note');
		
		
		//ATTRIBUTION DES VARIABLES
		$page = $this->_app->getPage();
		$page->setVars('test','COUCOU');
		$page->setVars('photoMeilleurNote',$listePhoto[0]);
		$page->setVars('listeDernierePhoto',$listeDernierePhoto);
		

	}
}