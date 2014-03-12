<?php
require "Photo.class.php";

//Création d'un object Image
$photo = new Photo(array(
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
			));

//Test de quelque fonction dessus
echo $photo->getId();
echo '<hr>';
echo $photo->getDate_import();
echo '<hr>';
echo $photo->getExtension();
echo '<hr>';
echo $photo->getLargeur();

?>