<?php
namespace Application\Backend\Modules\UploadPicture;

use \Library\Entities\Picture;

class UploadPictureControleur extends \Library\Controleur {

	use \Library\Validator;

	private $_fileExtension;

	public function run(){

		//Si le formulaire d'ajout d'image a été soumis
		if(isset($_POST['addpicture'])){

			//On ajoute l'image à la BDD et on la déplace dans le dossier Upload
			$this->addPicture();
		}

		//On récupère tous les albums 
		$albums = $this->getManagerof('Album')->getAll($this->getOrderAlbum());

		$validation = (count($albums) != 0) ? true : false;
		
		//On passe tous à la vue
		$this->_app->getPage()->setVars('validation', $validation);
		$this->_app->getPage()->setVars('albums', $albums);
		$this->_app->getPage()->setVars('title', '- Ajouter Image');
	}

	private function addPicture(){
		if(isset($_POST['name']) && $this->isValidString($_POST['name'])){
			
			//Instanciation des managers :
			$config = $this->getManagerof('Config');
			$PictureManager = $this->getManagerof('Picture');

			$name = str_replace(' ', '_', $_POST['name']);
			if(!preg_match('(\w)', $name)){
				$txt = "Merci de n'utiliser que les caractères autorisés pour le nom de l'image";	
			}else if($PictureManager->exist($_POST['name'])){
				$txt = "Ce nom existe déjà";
			}else if(!isset($_POST['description']) || !$this->isValidString($_POST['description'])){
				$txt = "Erreur dans la description de l'image";
			}else if(!isset($_FILES['fichier']) ||  !$this->isValidFile($_FILES['fichier'])){
				$txt = "Erreur dans l'importation de fichier";
			}else{
				

				//On déplace l'image sur le serveur
				$this->movePicture();

				//On créé l'object image
				$picture = $this->create($name);

				//On créé une miniature de l'image
				$width = $config->get('thumb_size');
				$quality =$config->get('thumb_quality');
				$picture->createThumb($picture->getWidth(), $picture->getHeight(),$this->_fileExtension,$width, $quality, $picture->getUrl(), $picture->getUrlmin());

				//On ajoute l'image à la BDD
				$PictureManager->add($picture);

				$txt = "Image bien ajoutée";
			}

		}else{
			$txt = "Erreur dans le nom de l'image";	
		}	

		$this->_app->getPage()->setVars('txt', $txt);
	}

	private function movePicture(){
		$fileName = pathinfo($_FILES['fichier']['name']);
        $this->_fileExtension = $fileName['extension'];
        $file = "".$_FILES['fichier']['name'];
        move_uploaded_file($_FILES['fichier']['tmp_name'], 'Uploads/pictures/' . basename($_POST['name'].'.'.$this->_fileExtension));
	}

	private function create($name){
		$date = date("Y-m-d H:i:s");

		$url = 'Uploads/pictures/'.$_POST['name'].'.'.$this->_fileExtension;
		$urlmin = 'Uploads/thumbs/pictures/'.$_POST['name'].'.'.$this->_fileExtension;

		$size = getimagesize($url);

		if(!isset($_POST['visibilite'])){
			$statut = 1;
		}else{
			$statut = $_POST['visibilite'];
		}

		return $picture = new Picture(array(
		  'id' => '0',
		  'name' => $this->toString($name),
		  'description' => $this->toString($_POST['description']),
		  'url' => $url,
		  'urlmin' => $urlmin,
		  'type' => $this->_fileExtension,
		  'size' => floor(filesize($url)/1024),
		  'width' =>  $size[0],
		  'height' => $size[1],
		  'date_import' => $date,
		  'public' => $statut,
		  'album_id' => $_POST['album']
		));
	}
}