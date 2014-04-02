<?php

namespace Application\Frontend\Modules\Album;


class AlbumControleur extends \Library\Controleur {
	
	public function run(){
		$managerPhoto = $this->getManagerOf('Photo');
		$managerAlbum = $this->getManagerOf('Album');

		$nomAlbum = $this->matches[1];
		$idAlbum = $managerAlbum->obtenirParId($nomAlbum)->getId();
		$listeImage = $managerPhoto->obtenirTous($idAlbum);

		$page = $this->_app->getPage();
		$page->setVars("listeImage", $listeImage);

	}
}
