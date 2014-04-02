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
		if($photo==NULL )
			$this->_app->getHTTPResponse()->error();
		
		if($photo->getAcces()==0)
			if($this->_app->getUser()->isAdmin())
				$this->_app->getHTTPResponse()->error();
		
		//ATTRIBUTION DES VARIABLES
		$page = $this->_app->getPage();
		$page->setVars('photo',$photo);
		
		

	}
}