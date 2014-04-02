<?php

namespace Library\Entites;

class Utilisateur extends \Library\Entities
	{
		private $id;
		private $mdp;
		private $mail;
		private $estAdmin;
		
		/************************************
		/			ACCESSEUR
		/***********************************/
		public function getIdentifiant()
		{
			return $this->id;
		}
		public function getMdp()
		{
			return $this->mdp;
		}
		public function getMail()
		{
			return $this->mail;
		}
		public function getEstAdmin(){
			return $this->estAdmin;
		}
		
		/************************************
		/			MODIFICATEUR
		/***********************************/
		public function setIdentifiant($ident)
		{
			if(isset($ident) && is_string($ident) )
				$this->id=$ident;
		}
		public function setMdp($var)
		{
			if(isset($var) && is_string($var))
				$this->mdp=$var;
		}
		public function setMail($var)
		{
			if(isset($var) && is_string($var))
				$this->mail=$var;
		}
		public function setEstAdmin($var){
			if(isset($var) && is_numeric($var))
				$this->estAdmin = $var;
		}
		
	}
?>