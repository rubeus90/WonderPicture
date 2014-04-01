<?php
namespace Library\Modeles;

use \Library\Entites\Album;

class AlbumManager extends \Library\Manager{

	public function ajouter(Album $album){
		
		try{
			$requetePrepa = $this->_db->prepare('INSERT INTO album(titre, description, acces, dateCreation, urlMiniature) VALUE(:titre, :description, :acces, :dateCreation, :urlMiniature)');
		
			$d = array(
				'titre' => $album->getTitre(),
				'description' => $album->getDescription(),
				'acces' => $album->getAcces(),
				'dateCreation' => $album->getDateCreation(),
				'urlMiniature' => $album->getURLMiniature()
				);
			if($requetePrepa->execute($d)){}
			else
			echo 'PROBLEME';
		}catch(exception $e){
			echo 'erreur de requete : ', $e->getMessage();
		}
	}

	public function supprimer(Album $album){
		$this->_db->exec('DELETE FROM album WHERE id = '.$album->id());
	}

	public function obtenir($id){
		$q = $this->_db->query('SELECT * FROM album WHERE id = '.$id);
		$donnees = $q->fetchAll(\PDO::FETCH_ASSOC);
		
		return new Album($donnees);
	}

	public function obtenirParId($titre){
		$q = $this->_db->query('SELECT * FROM album WHERE titre = \''.$titre.'\'');
		if($donnees = $q->fetch(\PDO::FETCH_ASSOC))
		return new Album($donnees);
		else
		return false;
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

	public function init()
		{
			$album = $this->obtenirParId('Blonde');
			if($album==false)
			{
				$query = $this->_db->exec('INSERT INTO album(titre,description,acces,dateCreation,urlMiniature) VALUE(\'Blonde\',\'Un album de blondes\',1,\'01/04/2014\',\'\')');
			}
			$album = $this->obtenirParId('Blonde');
			return $album->getId();
		}
}