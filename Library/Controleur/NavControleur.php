<?php
namespace Library\Controleur;

class NavControleur extends \Library\Controleur{

	public function run(){
		$albums = $this->_app->getUser()->isConnected() ? $this->getManagerof('Album')->getAll($this->getOrderAlbum()) : $this->getManagerof('Album')->getAllPublic($this->getOrderAlbum());
		$this->_app->getPage()->setVars('albums', $albums);
	}
}