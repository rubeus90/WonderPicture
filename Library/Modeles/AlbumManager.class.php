<?php
namespace Library\Modeles;

use \Library\Entites\Album

class AlbumManager extends \Library\Manager{

	public function ajouter(Album $album){
		try{
			$requetePrepa = $this->_db->prepare('INSERT INTO album(titre, description, acces, dateCreation, urlMiniature) VALUE(:titre, :description, :acces, :dateCreation, :urlMiniature)');
		
			$d = array(
				'titre' => $album->getTitre(),
				'description' => $album->getDescrition(),
				'acces' => $album->getAcces(),
				'dateCreation' => $album->getDateCreation(),
				'urlMiniature' => $album->getURLMiniature()
				);
			$requetePrepa->execute($d);
		}catch(exception $e){
			echo 'erreur de requete : ', $e->getMessage();
		}

	public function supprimer(Album $album){
		$this->_db->exec('DELETE FROM album WHERE id = '.$album->id());
	}

	public function obtenir($id){
		$q = $this->_db->query('SELECT * FROM album WHERE id = '.$id);
		$donnees = $q->fetchAll(PDO::FETCH_ASSOC);

		return new Album($donnees);
	}

	public function modifier(Album $album){
		$q = $this->_db->prepare('UPDATE album SET titre = :titre, description = :description, acces = :acces, dateCreation = :dateCreation, urlMiniature = :urlMiniature WHERE id = :id');

		$d = array(
			'titre' => $album->getTitre(),
			'description' => $album->getDescrition(),
			'acces' => $album->getAcces(),
			'dateCreation' => $album->getDateCreation(),
			'urlMiniature' => $album->getURLMiniature(),
			'id' => $album->getId()
			);
		$q->execute($d);
	}

}