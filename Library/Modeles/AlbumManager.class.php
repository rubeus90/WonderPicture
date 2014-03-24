<?php
namespace Library\Modeles;

require "Manager.class.php";

class AlbumManager extends Manager{

	public function ajouter(Album $album){
		try{
			$requetePrepa = $this->_db->prepare('INSERT INTO albums(titre, description, acces, dateCreation, urlMiniature) VALUE(:titre, :description, :acces, :dateCreation, :urlMiniature)');
		
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
		$this->_db->exec('DELETE FROM albums WHERE id = '.$album->id());
	}

	public function obtenir($id){
		$q = $this->_db->query('SELECT * FROM albums WHERE id = '.$id);
		$donnees = $q->fetchAll(PDO::FETCH_ASSOC);

		return new Album($donnees);
	}

	public function modifier(Album $album){
		$q = $this->_db->prepare('UPDATE albums SET titre = :titre, description = :description, acces = :acces, dateCreation = :dateCreation, urlMiniature = :urlMiniature WHERE id = :id');

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