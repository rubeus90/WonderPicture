<?php
require "Album.class.php";

//Création d'un object Image
$album = new Album(array(
			'id'=>'0',
			'titre' => "photo",
			'description' =>'rien',
			'acces' => 0,
			'date_creation'=> 'today',
			'urlMiniature' =>'rien'
			));

//Test de quelque fonction dessus
echo $album->getId();
echo $album->getDescription();
echo $album->getDate_creation();

?>