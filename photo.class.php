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
		
		
		
		/************************************
		/			ACCESSEUR
		/***********************************/
		public function getId()
		{
			return $this->$id;
		}
		public function getTitre()
		{
			return $this->$titre;
		}
		public function getDescription()
		{
			return $this->$description;
		}
		public function getUrl()
		{
			return $this->$url;
		}
		public function getUrlMiniature()
		{
			return $this->$urlMiniature;
		}
		public function getExtension()
		{
			return $this->$extension;
		}
		public function getPoids()
		{
			return $this->$poids;
		}
		public function getLargeur()
		{
			return $this->$largeur;
		}
		public function getHauteur()
		{
			return $this->$hauteur;
		}
		public function getDateImport()
		{
			return $this->$date_import;
		}
		public function getAcces()
		{
			return $this->$acces;
		}
		public function getAlbumId()
		{
			return $this->$album_id;
		}
		public function getNote()
		{
			return $this->$note;
		}
		public function getNombreVotant()
		{
			return $this->$nombreVotant;
		}
		/************************************
		/			MODIFICATEUR
		/***********************************/
		public function setId($ident)
		{
			if(isset($ident) && is_numeric($ident) && $ident>=0 )
				$id=$ident;
		}
		public function setTitre($var)
		{
			if(isset($var) && is_string($var))
				$titre=$var;
		}
		public function setDescription($var)
		{
			if(isset($var) && is_string($var))
				$description=$var;
		}
		public function setUrl($var)
		{
			if(isset($var) && is_string($var))
				$url=$var;
		}
		public function setUrlMiniature($var)
		{
			if(isset($var) && is_string($var))
				$urlMiniature=$var;
		}
		public function setExtension($var)
		{
			if(isset($var) && is_string($var))
				$extension=$var;
		}
		public function setPoids($var)
		{
			if(isset($var) && is_numeric($var) && $var>=0 )
				$poids=$var;
		}
		public function setLargeur($var)
		{
			if(isset($var) && is_numeric($var) && $var>=0 )
				$largeur=$var;
		}
		public function setHauteur($var)
		{
			if(isset($var) && is_numeric($var) && $var>=0 )
				$hauteur=$var;
		}
		public function setDateImport($var)
		{
			if(isset($var) && is_string($var))
				$date_import=$var;
		}
		public function setAcces($var)
		{
			if(isset($var) && is_bool($var) )
				$acces=$var;
		}
		public function setAlbumId($var)
		{
			if(isset($var) && is_numeric($var) && $var>=0 )
				$album_id=$var;
		}
		public function setNote($var)
		{
			if(isset($var) && is_numeric($var) && $var>=0 && $var<=10 )
				$note=$var;
		}
		public function setNombreVotant($var)
		{
			if(isset($var) && is_numeric($var) && $var>=0 )
				$nombreVotant=$var;
		}
		
		
	}
?>