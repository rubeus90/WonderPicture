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
		  
		  if($donnees->acces == 0)
				$acces=False;
		  else
				$acces=True;
		  
		  $objetPhoto = new Photo(array(
			'id'=>$donnees->id,
			'titre' => $donnees->titre,
			'description' => $donnees->description,
			'url' => $donnees->url,
			'urlMiniature' => $donnees->urlMiniature,
			'extension' => $donnees->extension,
			'poids' => $donnees->poids,
			'largeur' => $donnees->largeur,
			'hauteur' => $donnees->hauteur,
			'dateImport' => $donnees->dateImport,
			'acces' => $acces,
			'albumId' => $donnees->albumId,
			'note' => $donnees->note,
			'nombreVotant'=> $donnees->nombreVotant
			));
			
		  return $objetPhoto;
					
		}
	}
?>