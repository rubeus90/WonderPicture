<?php
class Photo extends Entities
	{
		private $id;
		private $titre;
		private $description;
		private $url;
		private $urlMiniature;
		private $extension;
		private $poids;
		private $largeur;
		private $hauteur;
		private $date_import;
		private $acces; //0 = privé , 1 = public
		private $album_id;
		private $note;
		private $nombreVotant;
		
		/*public __construct($pId,$pTitre,$pDesc,$pUrl,$pUrlMini,$pExt,$pPoids,$pLarg,$pLong,$pDate,$pAcces,$pAlbum,$pNote,$pNbVotant)
		{
			$this->id=$pId;
			$this->titre=$pTitre;
			$this->description=$pDesc;
			$this->url=$pUrl;
			$this->urlMiniature=$pUrlMini;
			$this->extension=$pExt;
			$this->poids=$pPoids;
			$this->largeur=$pLarg;
			$this->hauteur=$Long;
			$this->date_import=$pDate;
			$this->acces=$pAcces;
			$this->album_id=$pAlbum;
			$this->note=$pNote;
			$this->nombreVotant=$pNbVotant;
		}*/
		
		/************************************
		/			ACCESSEUR
		/***********************************/
		public function getId()
		{
			return $this->id;
		}
		public function getTitre()
		{
			return $this->titre;
		}
		public function getDescription()
		{
			return $this->description;
		}
		public function getUrl()
		{
			return $this->url;
		}
		public function getUrlMiniature()
		{
			return $this->urlMiniature;
		}
		public function getExtension()
		{
			return $this->extension;
		}
		public function getPoids()
		{
			return $this->poids;
		}
		public function getLargeur()
		{
			return $this->largeur;
		}
		public function getHauteur()
		{
			return $this->hauteur;
		}
		public function getDateImport()
		{
			return $this->date_import;
		}
		public function getAcces()
		{
			return $this->acces;
		}
		public function getAlbumId()
		{
			return $this->album_id;
		}
		public function getNote()
		{
			return $this->note;
		}
		public function getNombreVotant()
		{
			return $this->nombreVotant;
		}
		/************************************
		/			MODIFICATEUR
		/***********************************/
		public function setId($ident)
		{
			if(isset($ident) && is_numeric($ident) && $ident>=0 )
				$this->id=$ident;
		}
		public function setTitre($var)
		{
			if(isset($var) && is_string($var))
				$this->titre=$var;
		}
		public function setDescription($var)
		{
			if(isset($var) && is_string($var))
				$this->description=$var;
		}
		public function setUrl($var)
		{
			if(isset($var) && is_string($var))
				$this->url=$var;
		}
		public function setUrlMiniature($var)
		{
			if(isset($var) && is_string($var))
				$this->urlMiniature=$var;
		}
		public function setExtension($var)
		{
			if(isset($var) && is_string($var))
				$this->extension=$var;
		}
		public function setPoids($var)
		{
			if(isset($var) && is_numeric($var) && $var>=0 )
				$this->poids=$var;
		}
		public function setLargeur($var)
		{
			if(isset($var) && is_numeric($var) && $var>=0 )
				$this->largeur=$var;
		}
		public function setHauteur($var)
		{
			if(isset($var) && is_numeric($var) && $var>=0 )
				$this->hauteur=$var;
		}
		public function setDate_import($var)
		{
			if(isset($var) && is_string($var))
				$this->date_import=$var;
		}
		public function setAcces($var)
		{
			if(isset($var) && is_bool($var) )
				$this->acces=$var;
		}
		public function setAlbumId($var)
		{
			if(isset($var) && is_numeric($var) && $var>=0 )
				$this->album_id=$var;
		}
		public function setNote($var)
		{
			if(isset($var) && is_numeric($var) && $var>=0 && $var<=10 )
				$this->note=$var;
		}
		public function setNombreVotant($var)
		{
			if(isset($var) && is_numeric($var) && $var>=0 )
				$this->nombreVotant=$var;
		}
		
		
	}
?>