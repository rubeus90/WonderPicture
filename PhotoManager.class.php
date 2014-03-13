<?php
	require "Manager.class.php";

	class PhotoManager extends Manager
	{
			
		public function ajouter($photo)
		{
			$requetePrepa = $this->_db->prepare(
				'INSERT INTO Photo SET
					titre=:TITRE,
					description=:DESCRIPTION,
					url=:URL,
					urlMiniature=:URLMINIATURE,
					extension=:EXTENSION,
					poids=:POIDS,
					largeur=:LARGEUR,
					hauteur=:HAUTEUR,
					date_import=:DATE,
					acces=:ACCES,
					album_id:=ALBUMID,
					note=:NOTE,
					nombreVotant=:NBVOTANT'
				);	
				
			$requetePrepa->bindValue(':TITRE',$photo->getTitre());
			$requetePrepa->bindValue(':DESCRIPTION',$photo->getDescription());
			$requetePrepa->bindValue(':URL',$photo->getUrlMiniature());
			$requetePrepa->bindValue(':EXTENSION',$photo->getExtension());
			$requetePrepa->bindValue(':POIDS',$photo->getPoids());
			$requetePrepa->bindValue(':LARGEUR',$photo->getLargeur());
			$requetePrepa->bindValue(':HAUTEUR',$photo->getHauteur());
			$requetePrepa->bindValue(':DATE',$photo->getDateImport());
			$requetePrepa->bindValue(':ACCES',$photo->getAcces());
			$requetePrepa->bindValue(':ALBUMID',$photo->getAlbumId());
			$requetePrepa->bindValue(':NOTE',$photo->getNote());
			$requetePrepa->bindValue(':NBVOTANT',$photo->getNombreVotant());
			
			$requetePrepa->execute();
		}
		
		public function supprimer($photo)
		{	
		  $query = $this->$bdd->exec('DELETE FROM parametres WHERE id='.$photo);
		}
		
		public function obtenir($photo)
		{
		  $query = $this->$bdd->exec('SELECT FROM parametres WHERE id='.$photo);
		  $donnees= $query->fetch(\PDO::FETCH_OBJ);
		  
		  $objetPhoto = new Photo(
					$donnees->id,
					$donnees->titre,
					$donnees->description,
					$donnees->url,
					$donnees->urlMiniature,
					$donnees->extension,
					$donnees->poids,
					$donnees->largeur,
					$donnees->hauteur,
					$donnees->dateImport,
					$donnees->acces,
					$donnees->albumId,
					$donnees->note,
					$donnees->nombreVotant);
					
		}
	}
?>