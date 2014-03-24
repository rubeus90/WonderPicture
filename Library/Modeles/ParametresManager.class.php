<?php

namespace Library\Modeles;
class ParametresManager extends Manager{

	public function ajouter(Parametres $param){
		$query = $this->_db->prepare('INSERT INTO parametres SET resolutionMiniature=:resolutionMiniature, qualiteMiniature=:qualiteMiniature, ordre_photo=:ordre_photo, ordre_album=:ordre_album, nombreAffichage=:nombreAffichage');
		
		$query->bindValue(':resolutionMiniature', $param->getResolutionMiniature());
		$query->bindValue(':qualiteMiniature', $param->getQualiteMiniature());
		$query->bindValue(':ordre_photo', $param->getOrdre_photo());
		$query->bindValue(':ordre_album', $param->getOrdre_album());
		$query->bindValue(':nombreAffichage', $param->getNombreAffichage());

		$query->execute();
	}

	public function supprimer(Parametres $param){
		$query = $this->_db->exec('DELETE FROM parametres WHERE id='.$param->id());
	}

	public function get($id){
		$query = $this->_db->exec('SELECT resolutionMiniature, qualiteMiniature, ordre_photo, ordre_album, nombreAffichage WHERE id='.$id);
		$donnees= $query->fetch(PDO::FETCH_ASSOC);	

		return new Parametres($donnees);
	}

	public function update(Parametres $param){
		$query = $this->_db->prepare('UPDATE parametres SET resolutionMiniature=:resolutionMiniature, qualiteMiniature=:qualiteMiniature, ordre_photo=:ordre_photo, ordre_album=:ordre_album, nombreAffichage=:nombreAffichage WHERE id=:id');
		
		$query->bindValue(':resolutionMiniature', $param->getResolutionMiniature());
		$query->bindValue(':qualiteMiniature', $param->getQualiteMiniature());
		$query->bindValue(':ordre_photo', $param->getOrdre_photo());
		$query->bindValue(':ordre_album', $param->getOrdre_album());
		$query->bindValue(':nombreAffichage', $param->getNombreAffichage());
		$query->bindValue(':id', $param->getId());

		$query->execute();
	}
}