<?php
namespace Application\Frontend\Modules\Gallerie;

class GallerieControleur extends \Library\Controleur{

	public function run(){

		//On récupère le nom de l'album
		$title = $this->_vars[1];
		$albumManager = $this->getManagerof('Album');

		//Si l'album n'existe pas
		if(!$albumManager->exist($title)){
			$this->_app->getHTTPResponse()->error();
		}
			
		//On récupère l'album correspondant au nom de l'album qui se trouve dans l'URL
		$album = $albumManager->getByTitle($title);

		//Si l'album n'est pas public et que le visiteur n'est pas connecté
		if(!$album->isPublic() && !$this->_app->getUser()->isConnected()){
			$this->_app->getHTTPResponse()->redirect("/");	
		}

		//On récupère toutes les images de l'album
		$pictures =  ( $this->_app->getUser()->isConnected()) ? $this->getManagerof('Picture')->getAlbum($album->getId(), $this->getOrderPicture()) : $this->getManagerof('Picture')->getAlbumPublic($album->getId(), $this->getOrderPicture());	
		
		//On passe le tout à la vue
		$this->_app->getPage()->setVars('pictures', $pictures);
		$this->_app->getPage()->setVars('album', $album);
		$this->_app->getPage()->setVars('title', '- '.$album->getName());
	}
}