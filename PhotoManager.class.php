<?php
	require "Manager.class.php";

	class PhotoManager extends Manager
	{
			
		public function ajouter($photo)
		{
			$requetePrepa = $this->_db->prepare(
				'INSERT 
				INTO 
				photo(titre,description,url,urlMiniature,extension,poids,largeur,hauteur,dateImport,acces,albumId,note,nombreVotant) 
				VALUE
				(:TITRE,:DESCRIPTION,:URL,:URLMINIATURE,:EXTENSION,:POIDS,:LARGEUR,:HAUTEUR,:DATE,:ACCES,:ALBUMID,:NOTE,:NBVOTANT)'
				);	
			try{	
				
				if($photo->getAcces())
					$acces = 1;
				else
					$acces = 0;
			
			$d = array(
				':TITRE'=>$photo->getTitre(),
				':DESCRIPTION'=>$photo->getDescription(),
				':URL'=>$photo->getUrl(),
				':URLMINIATURE'=>$photo->getUrlMiniature(),
				':EXTENSION'=>$photo->getExtension(),
				':POIDS'=>$photo->getPoids(),
				':LARGEUR'=>$photo->getLargeur(),
				':HAUTEUR'=>$photo->getHauteur(),
				':DATE'=>$photo->getDateImport(),
				':ACCES'=>$acces,
				':ALBUMID'=>$photo->getAlbumId(),
				':NOTE'=>$photo->getNote(),
				':NBVOTANT'=>$photo->getNombreVotant()
			);
			
			$requetePrepa->execute($d);
			
			}
			catch (exception $e)
			{
				echo 'erreur de requète : ', $e->getMessage();
			}
		}
		
		public function supprimer($photo)
		{	
		  $query = $this->_db->exec('DELETE FROM photo WHERE id='.$photo);
		}
		
		public function obtenir($photo)
		{
		  $query = $this->_db->query('SELECT * FROM photo WHERE id='.$photo);
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
					
		  return $objetPhoto;
					
		}
	}
?>