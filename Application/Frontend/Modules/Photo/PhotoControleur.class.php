<?php

namespace Application\Frontend\Modules\Photo;

class PhotoControleur extends \Library\Controleur {
	
	public function run(){
	
		
	
		//PARAMETRES
		$photoID = $this->matches[2];
		
		//RECUPERATION MANAGER
		$managerPhoto = $this->getManagerof('Photo');
		
		//CREATION DES DONNEES
		$photo = $managerPhoto->obtenir($photoID);
		
		//ATTRIBUTION DES VARIABLES
		$page = $this->_app->getPage();
		$page->setVars('photo',$photo);
		
		

	}
}