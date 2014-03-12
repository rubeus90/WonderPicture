<?php
require "Parametre.class.php";

//Création d'un object Image
$param = new Parametre(array(
			'id'=>'0',
			'resolutionMiniature' => 400,
			'qualiteMiniature' => 6,
			'ordre_photo' => 'date',
			'ordre_album'=> 'date',
			'nombreAffichage' => 6
			));

//Test de quelque fonction dessus
echo $param->getId();
echo $param->getOrdre_album();
echo $param->getOrdre_photo();

?>