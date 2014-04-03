<?php
namespace Application\Backend\Modules\Album;


class AlbumControleur extends \Library\Controleur {

	use \Library\Validator;

	private $_AlbumManager,
		$_PictureManager;


	public function run(){

		//On instancie les mamangers :
		$this->_AlbumManager = $this->getManagerof('Album');
		$this->_PictureManager = $this->getManagerof('Picture');

		//Test de la méthode à appeler
		if(isset($_POST['erase']) && isset($_POST["id"])){
			$this->delete($_POST["id"]);
		}else if(isset($_POST['edit']) && isset($_POST["id"])){
			$this->edit($_POST["id"]);
		}else if(isset($_POST['erasealbum']) && isset($_POST["id"])){
			$this->deleteAlbum($_POST["id"]);
		}else if(isset($_POST['editalbum']) && isset($_POST["id"])){
			$this->editAlbum($_POST["id"]);
		}

		//On récupère le nom de l'album
		$title = $this->_vars[2];

		//Si l'album n'existe pas
		if(!$this->_AlbumManager->exist($title)){
			$this->_app->getHTTPResponse()->error();
		}
			
		//On récupère l'album correspondant au nom de l'album qui se trouve dans l'URL
		$album = $this->_AlbumManager->getByTitle($title);

		//On récupère toutes les images de l'album
		$pictures = $this->_PictureManager->getAlbum($album->getId(), $this->getOrderPicture());	
		
		//On passe le tout à la vue -- les albums sont définis grace au menu
		$this->_app->getPage()->setVars('pictures', $pictures);
		$this->_app->getPage()->setVars('album', $album);
		$this->_app->getPage()->setVars('title', '- '.$album->getName());
	}

	private function delete($id){
		if($this->exist($id)){
			$picture = $this->_PictureManager->get($id);

			unlink($picture->getUrl());
			unlink($picture->getUrlmin());

			$this->_PictureManager->delete($id);	
		}
	}

	private function edit($id){
		if($this->exist($id)){
			$picture = $this->_PictureManager->get($id);

			//Vérification dans les setters
			$picture->setPublic($_POST['visibilite']);
			$picture->setAlbum_id($_POST['album']);

			$this->_PictureManager->update($picture);
		}
	}

	private function deleteAlbum($id){
		if($this->exist($id)){
			//On récupère toutes les images de l'album
			$pictures = $this->_PictureManager->getAlbum($id, 'id');

			//On les supprimes toutes
			foreach($pictures as $picture){
				$this->delete($picture->getId());
			}

			//On supprime la miniature de l'album
			unlink($this->_AlbumManager->get($id)->getThumb());

			//On supprime l'album de la BDD
			$this->_AlbumManager->delete($id);

			$this->_app->getHTTPResponse()->redirect("/admin");
		}
	}

	private function editAlbum($id){
		if($this->exist($id)){
			$album = $this->_AlbumManager->get($id);
			
			//Vérification dans les setters
			$album->setPublic($_POST['visibilite']);
			$this->_AlbumManager->update($album);

			//On recupère les images pour mettre a jour les visibilité
			$pictures = $this->_PictureManager->getAlbum($id, 'id');
			foreach($pictures as $picture){
				$picture->setPublic($_POST['visibilite']);
				$this->_PictureManager->update($picture);
			}
		}
	}
}