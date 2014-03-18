<?php
//On charge l'autoload pour charger les classes automatiquement
require "autoload.php";


//ENTITES
testPhoto();
//testAlbum();
//testParametres();
testAdmin();

//MANAGER
testPhotoManager();
//testAlbumManager()
testParametresManager();
testAdminManager();

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

function testAdmin(){
	echo "<hr>Test de l'objet Admin <hr>";
	$donnee = array(
			'identifiant'=>"Thibault",
			'mdp' => "moi",
			'mail' => "mathieuNgocky.thibaultQuentin@edu.esiee.fr"
			);
	$admin = new Admin($donnee);

	foreach($donnee as $key => $param){
		$method = 'get'.ucfirst($key);
		echo "Appel de la methode $method. Resultat : <br />";
		if(method_exists($admin, $method)){
			$result = $admin->$method();
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
			'albumId' => 3,
			'note' => 2,
			'nombreVotant'=> 2
			)));
	echo "Appel de la methode obtenir. Resultat :<br/>";
	$photo = $PhotoManager->obtenir(20);
	if($photo!=NULL){
		echo "Recupération de l'id : ";
		echo $photo->getId();echo "<br/>";
		echo "Recupération du titre : ";
		echo $photo->getTitre();echo "<br/>";
		echo "Recupération de la desciption : ";
		echo $photo->getDescription();echo "<br/>";
		echo "Recupération de l'url : ";
		echo $photo->getUrl();echo "<br/>";
		echo "Recupération de l'url de la miniature : ";
		echo $photo->getUrlMiniature();echo "<br/>";
		echo "Recupération de l'extension : ";
		echo $photo->getExtension();echo "<br/>";
		echo "Recupération du poids : ";
		echo $photo->getPoids();echo "<br/>";
		echo "Recupération de la largeur : ";
		echo $photo->getLargeur();echo "<br/>";
		echo "Recupération de la hauteur : ";
		echo $photo->getHauteur();echo "<br/>";
		echo "Recupération de la date d'import : ";
		echo $photo->getDateImport();echo "<br/>";
		echo "Recupération de l'acces : ";
		if($photo->getAcces()) echo "True"; else echo "False"; echo "<br/>";
		echo "Recupération de l'album : ";
		echo $photo->getAlbumId();echo "<br/>";
		echo "Recupération de la note : ";
		echo $photo->getNote();echo "<br/>";
		echo "Recupération du nombre de votant : ";
		echo $photo->getNombreVotant();echo "<br/>";
		
	}
	else
		echo "Pas de photo avec l'id 1<br/>";

	$PhotoManager->supprimer(2);
	$PhotoManager->viderAlbum(1);
	
	echo "<br/>Appel de la methode obtenir. Resultat :<br/>";
	$listePhoto = $PhotoManager->obtenirTous(3);
	$numero = 1;
	foreach($listePhoto as $p)
	{
		echo "Recuperation de la photo numero ".$numero." ID = ";
		echo $p->getId();echo "<br/>";
		$numero++;
	}
	
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

function testAdminManager(){
    echo "<hr>Test de l'objet AdminManager <hr>";
	$pdo = Connexion();
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	$AdminManager = new AdminManager($pdo);
	
	$AdminManager->supprimer("Thibault");
	
	$donnee = array(
			'identifiant'=>"Thibault",
			'mdp' => "moi",
			'mail' => "mathieuNgocky.thibaultQuentin@edu.esiee.fr"
			);
	$admin = new Admin($donnee);
	$AdminManager->ajouter($admin);
	
	echo "Appel de la methode obtenir. Resultat :<br/>";
	$ad = $AdminManager->obtenir("Thibault");
	if($ad!=NULL){
		echo "Recupération de l'Id : ";
		echo $ad->getIdentifiant();echo "<br/>";
		echo "Recupération de l'Id : ";
		echo $ad->getMdp();echo "<br/>";
		echo "Recupération de l'Id : ";
		echo $ad->getMail();echo "<br/>";
	}
	else
		echo "Pas de photo avec l'id Thibault<br/>";
}

?>