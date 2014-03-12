<?php
	class Album extends Entities{
		private $_id;
		private $_titre;
		private $_description;
		private $_acces; //0 prive | 1 public
		private $_date_creation;
		private $_urlMiniature;
		
		public function __construct(){
			
		}
		
		public function getId(){
			return $this->$_id;
		}

		public function setId($id){
			if(isset($id) && $id>0 && is_numeric($id)){
				$this->$_id = $id;
			}
		}

		public function getTitre(){
			return $this->$_titre;
		}

		public function setTitre($titre){
			if(isset($titre) && is_string($titre) && !empty($titre)){
				$this->$_titre = $titre;
			}
		}

		public function getDescription(){
			return $this->$_description;
		}

		public function setDescription($desc){
			if(isset($desc) && is_string($desc) && !empty($desc)){
				$this->$_description = $desc;
			}
		}

		public function getAcces(){
			return $this->$_id;
		}

		public function setAcces($acces){
			if(isset($acces) && is_bool($acces)){
				$this->$_acces = $acces;
			}
		}

		public function getDateCreation(){
			return $this->$_date_creation;
		}

		public function setDateCreation($date){
			if(isset($date) && is_string($date) && !empty($date)){
				$this->$_date_creation = $date;
			}
		}

		public function getURLMiniature(){
			return $this->$_urlMiniature;
		}

		public function setURLMiniature($url){
			if(isset($url) && is_string($url) && !empty($url)){
				$this->$urlMiniature = $url;
			}
		}

	}
?>
