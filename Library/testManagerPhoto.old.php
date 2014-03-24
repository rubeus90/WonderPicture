<?php
	require "photo.class.php";
	require "PhotoManager.class.php";			
				
	$photo = new Photo(0,"photo2","Unephoto2","rien2","rien2","pdf",14,14,14,'TODAY',0,1,2,2);
				echo $photo->getId();
				echo $photo->getTitre();
				echo $photo->getDescription();
				echo $photo->getUrl();
				echo $photo->getUrlMiniature();
				echo $photo->getExtension();
				echo $photo->getPoids();
				echo $photo->getLargeur();
				echo $photo->getHauteur();
				echo $photo->getDateImport();
				echo $photo->getAcces();
				echo $photo->getAlbumId();
				echo $photo->getNote();
				echo $photo->getNombreVotant();
				
				echo "<br/>";
	
	$db = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$manager = new PhotoManager($db);

	$manager->ajouter($photo);
	
	$photorecup = $manager->obtenir(5);
	
				echo $photorecup->getId();
				echo $photorecup->getTitre();
				echo $photorecup->getDescription();
				echo $photorecup->getUrl();
				echo $photorecup->getUrlMiniature();
				echo $photorecup->getExtension();
				echo $photorecup->getPoids();
				echo $photorecup->getLargeur();
				echo $photorecup->getHauteur();
				echo $photorecup->getDateImport();
				echo $photorecup->getAcces();
				echo $photorecup->getAlbumId();
				echo $photorecup->getNote();
				echo $photorecup->getNombreVotant();
				
				echo "<br/>";
	
	$manager->supprimer(2);
			
?>