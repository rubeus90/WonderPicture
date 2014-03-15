<?php
//On charge l'autoload pour charger les classes automatiquement
require "autoload.php";


//ENTITES
testPhoto();
//testAlbum();
//testParametres();

//MANAGER
testPhotoManager();
//testAlbumManager()
testParametresManager();

/***********************************
*
*		METHODE DE TEST
*
***********************************/
function testPhoto(){
	echo "<hr>Test de l'objet Photo <hr>";
	$donnee = array(
			'id'=>'0',
			'titre' => "photo",
			'description' => "Une photo",
			'url' => "rien",
			'urlMiniature' => "rien",
			'extension' => "pdf",
			'poids' => 14,
			'largeur' => 14,
			'hauteur' => 14,
			'dateImport' => 'TODAY',
			'acces' => False,
			'albumId' => 1,
			'note' => 2,
			'nombreVotant'=> 2
			);
	$photo = new Photo($donnee);

	foreach($donnee as $key => $param){
		$method = 'get'.ucfirst($key);
		echo "Appel de la methode $method. Resultat : <br />";
		if(method_exists($photo, $method)){
			$result = $photo->$method();
			if($result == NULL){
				echo "Resultat NULL, probleme dans le Mutateur <br /><br />";
			}else{
				echo "$key = $result <br /><br />";
			}
		}	
		else{
			echo "La methode $method n'existe pas. Surement un probleme de nom <br /><br />";
		}
	}
}

function testAlbum(){
	echo "<hr>Test de l'objet Album <hr>";
	$donnee = array(
			'id'=>'0',
			'titre' => "photo",
			'description' =>'rien',
			'acces' => 0,
			'date_creation'=> 'today',
			'urlMiniature' =>'rien'
			);
	$album = new Album($donnee);

	foreach($donnee as $key => $param){
		$method = 'get'.ucfirst($key);
		echo "Appel de la methode $method. Resultat : <br />";
		if(method_exists($album, $method)){
			$result = $album->$method();
			if($result == NULL){
				echo "Resultat NULL, probleme dans le Mutateur <br /><br />";
			}else{
				echo "$key = $result <br /><br />";
			}
		}	
		else{
			echo "La methode $method n'existe pas. Surement un probleme de nom <br /><br />";
		}
	}
}

function testParametres(){
	echo "<hr>Test de l'objet Param <hr>";

	$donnee = array(
			'id'=>7,
			'resolutionMiniature' => 400,
			'qualiteMiniature' => 6,
			'ordre_photo' => 'WTF',
			'ordre_album'=> 'WTF',
			'nombreAffichage' => 6
			);
	$param = new Parametres($donnee);
	
	foreach($donnee as $key => $param){
		$method = 'get'.ucfirst($key);
		echo "Appel de la methode $method. Resultat : <br />";
		if(method_exists($param, $method)){
			$result = $param->$method();
			if($result == NULL){
				echo "Resultat NULL, probleme dans le Mutateur <br /><br />";
			}else{
				echo "$key = $result <br /><br />";
			}
		}	
		else{
			echo "La methode $method n'existe pas. Surement un probleme de nom <br /><br />";
		}
	}
}

function Connexion(){
	/******************************
	*
	*	A MODIFIER CELON VOTRE BDD
	*
	*******************************/
	$host = 'localhost';
	$db ='wonderpicture';
	$login = 'root';
	$pass ='';

	/********************************/

	$connexion = new Connexion($host, $db, $login, $pass);
	return $connexion->getPDO();	
}

function testPhotoManager(){
	echo "<hr>Test de l'objet PhotoManager <hr>";
	$pdo = Connexion();
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	$PhotoManager = new PhotoManager($pdo);
	$PhotoManager->ajouter(new Photo(array(
			'id'=>'0',
			'titre' => "photo",
			'description' => "Une photo",
			'url' => "rien",
			'urlMiniature' => "rien",
			'extension' => "pdf",
			'poids' => 14,
			'largeur' => 14,
			'hauteur' => 14,
			'dateImport' => 'TODAY',
			'acces' => False,
			'albumId' => 1,
			'note' => 2,
			'nombreVotant'=> 2
			)));
	$photo = $PhotoManager->obtenir(1);
	echo $photo->getId();echo "<br/>";
	echo $photo->getTitre();echo "<br/>";
	echo $photo->getDescription();echo "<br/>";
	echo $photo->getUrl();echo "<br/>";
	echo $photo->getUrlMiniature();echo "<br/>";
	echo $photo->getExtension();echo "<br/>";
	echo $photo->getPoids();echo "<br/>";
	echo $photo->getLargeur();echo "<br/>";
	echo $photo->getHauteur();echo "<br/>";
	echo $photo->getDateImport();echo "<br/>";
	echo $photo->getAcces();echo "<br/>";
	echo $photo->getAlbumId();echo "<br/>";
	echo $photo->getNote();echo "<br/>";
	echo $photo->getNombreVotant();echo "<br/>";
	$photo = $PhotoManager->supprimer(2);
	
}

function testAlbumManager(){
	$pdo = Connexion();
	$PhotoManager = new AlbumManager($pdo);
	$PhotoManager->ajouter(new Photo(array(
			'id'=>'0',
			'titre' => "photo",
			'description' => "Une photo",
			'url' => "rien",
			'urlMiniature' => "rien",
			'extension' => "pdf",
			'poids' => 14,
			'largeur' => 14,
			'hauteur' => 14,
			'date_import' => 'TODAY',
			'acces' => 0,
			'album_id' => 1,
			'note' => 2,
			'nombreVotant'=> 2
			)));
}

function testParametresManager(){
	$pdo = Connexion();
	$PhotoManager = new ParametresManager($pdo);
	$PhotoManager->ajouter(new Parametres(array(
			'id'=>7,
			'resolutionMiniature' => 400,
			'qualiteMiniature' => 6,
			'ordre_photo' => 'WTF',
			'ordre_album'=> 'WTF',
			'nombreAffichage' => 6
			)));
}

?>