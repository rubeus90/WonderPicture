<?php
namespace Application\Backend\Modules\UploadAlbum;

use \Library\Entities\Album;

class UploadAlbumControleur extends \Library\Controleur {

	use \Library\Validator;

	private $_fileExtension,
		$_width,
		$_height;

	public function run(){

		//Si le formulaire d'ajout d'album a été soumis
		if(isset($_POST['addalbum'])){

			//On ajoute l'album à la BDD
			$this->addAlbum();
		}

		$this->_app->getPage()->setVars('title', '- Ajouter Album');
	}

	private function addAlbum(){
		//On instancie les mananger:
		$AlbumManager = $this->getManagerof('Album');	
		$Config = $this->getManagerof('Config');

		$url = ['admin','Register','Connexion','Profil','Deconnexion'];
		if(!$this->isValidString($_POST['name']) || preg_match('(/s+)', $_POST['name']) || !preg_match('(\w+)', $_POST['name']) || in_array($_POST['name'],$url)){
			$txt = "Erreur dans le nom de l'album";
		}else if($AlbumManager->exist($_POST['name'])){
			$txt = "Ce nom d'album existe déjà";
		}else if(!$this->isValidString($_POST['description'])){
			$txt = "Erreur dans la description de l'album";
		}else if(!$this->isValidFile($_FILES['fichier'])){
			$txt = "Erreur dans l'importation de fichier";
		}else{

			//On déplace la miniature sur le serveur
			$this->movePicture();

			//On créé l'object Album
			$album = $this->create();

			//On créé la miniature de l'image
			$album->createThumb($this->_width,$this->_height,$this->_fileExtension,100, 60, $album->getThumb(), $album->getThumb());

			//On ajoute à la BDD l'object Album créé avec la fonction create()
			$AlbumManager->add($album);

			//Message pour l'utilisateur
			$txt = "Album bien ajouté";
		}

		$this->_app->getPage()->setVars('txt', $txt);
	}

	private function movePicture(){
		$fileName = pathinfo($_FILES['fichier']['name']);
        $this->_fileExtension = $fileName['extension'];
        $file = "".$_FILES['fichier']['name'];
        move_uploaded_file($_FILES['fichier']['tmp_name'], 'Uploads/thumbs/albums/' . basename($_POST['name'].'.'.$this->_fileExtension));
	}

	private function create(){
		$date = date("Y-m-d H:i:s");

		$thumb = 'Uploads/thumbs/albums/'.$_POST['name'].'.'.$this->_fileExtension;

		$size = getimagesize($thumb);

		$this->_width = $size[0];
		$this->_height = $size[1];

		return $album = new Album(array(
			'id'=>'0',
			'name' => $this->toString($_POST['name']),
			'description' => $this->toString($_POST['description']),
			'date_create' => $date,
			'public' => $_POST['visibilite'],
			'thumb' => $thumb
			));
	}
}