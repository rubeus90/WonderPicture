<?php
namespace Library\Modeles;

	use \Library\Entites\Photo;

	class PhotoManager extends \Library\Manager
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
		  $objetPhoto =NULL;
		  
		  if($donnees= $query->fetch(\PDO::FETCH_OBJ))
		  {
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
			}	
			return $objetPhoto;
					
		}
		
		public function presenceParChemin($photo)
		{
		  $query = $this->_db->query('SELECT * FROM photo WHERE url=\''.$photo.'\'');
		  $objetPhoto =NULL;
		  
		  if($donnees= $query->fetch(\PDO::FETCH_OBJ))
		  {
			  return true;
			}	
			return false;
					
		}
		
		public function viderAlbum($album)
		{
			$query = $this->_db->query('SELECT * FROM photo WHERE albumId='.$album);
			 while( $donnees= $query->fetch(\PDO::FETCH_OBJ) ) 
			 {
				$this->supprimer($donnees->id);
			 }
		}
		
		public function obtenirTous($album)
		{
			$query = $this->_db->query('SELECT * FROM photo WHERE albumId='.$album);
			$donnees= $query->fetchAll(\PDO::FETCH_OBJ);
			$liste = array();
			foreach( $donnees as $photo ){
				if($photo->acces == 0)
					$acces=False;
			  else
					$acces=True;
			  
			  $liste[] = new Photo(array(
				'id'=>$photo->id,
				'titre' => $photo->titre,
				'description' => $photo->description,
				'url' => $photo->url,
				'urlMiniature' => $photo->urlMiniature,
				'extension' => $photo->extension,
				'poids' => $photo->poids,
				'largeur' => $photo->largeur,
				'hauteur' => $photo->hauteur,
				'dateImport' => $photo->dateImport,
				'acces' => $acces,
				'albumId' => $photo->albumId,
				'note' => $photo->note,
				'nombreVotant'=> $photo->nombreVotant
				));
			}
			
			return $liste;
		}
		
		public function obtenirListe($debut = -1,$limite= -1,$colonne='id')
		{
			$sql = 'SELECT * FROM photo ORDER BY '.$colonne.' DESC';
			
			if ($debut != -1 || $limite != -1)
			{
				$sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
			}
			
			$query = $this->_db->query($sql);
			
			$donnees= $query->fetchAll(\PDO::FETCH_OBJ);
			$liste = array();
			foreach( $donnees as $photo ){
				if($photo->acces == 0)
					$acces=False;
			  else
					$acces=True;
			  
			  $liste[] = new Photo(array(
				'id'=>$photo->id,
				'titre' => $photo->titre,
				'description' => $photo->description,
				'url' => $photo->url,
				'urlMiniature' => $photo->urlMiniature,
				'extension' => $photo->extension,
				'poids' => $photo->poids,
				'largeur' => $photo->largeur,
				'hauteur' => $photo->hauteur,
				'dateImport' => $photo->dateImport,
				'acces' => $acces,
				'albumId' => $photo->albumId,
				'note' => $photo->note,
				'nombreVotant'=> $photo->nombreVotant
				));
			}
			
			return $liste;
		}
		
		public function init($id)
		{
			$bool = $this->presenceParChemin('Image\/Photo\/BlondeBBT.jpg');
			
			if($bool==false)
			{
				$query = $this->_db->exec('INSERT INTO 
											photo(titre,description,url,urlMiniature,extension,poids,largeur,hauteur,dateImport,acces,albumId,note,nombreVotant) 
											VALUE(\'Penny ! Penny ! Penny !\',
												\'A beautiful girl in a beautiful world\',
												\'Image\/Photo\/BlondeBBT.jpg\',
												\'Image\/MiniaturePhoto\/BlondeBBT.jpg\',
												\'jpg\',
												190,
												1280,
												1024,
												\'01\/04\/2014\',
												1,
												'.$id.',
												5,
												1)');
			}
			
		}
	}
	
	
	
?>