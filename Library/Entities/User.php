<?php
namespace Library\Entities;

class User extends \Library\Entity{
	private $_id,
	$_name,
	$_email,
	$_password,
	$_avatar,
	$_statut;


	// GETTER 
	public function getId(){
		return $this->_id;
	}

	public function getName(){
		return $this->_name;
	}

	public function getEmail(){
		return $this->_email;
	}

	public function getPassword(){
		return $this->_password;
	}

	public function getAvatar(){
		return $this->_avatar;
	}

	public function getStatut(){
		return $this->_statut;
	}

	//SETTER
	public function setId($id){
		$this->_id = (int) $id;
	}

	public function setName($name){
		if (is_string($name) && !empty($name)){
			$this->_name = $name;
		}
	}

	public function setEmail($email){
		if(is_string($email) && !empty($email)){
			$this->_email = $email; 
		}
	}

	public function setPassword($password){
		if(!empty($password)){
			$this->_password = $password; 
		}
	}

	public function setAvatar($avatar){
		if(!empty($avatar)){
			$this->_avatar = $avatar;
		}
	}

	public function setStatut($statut){
		$this->_statut = (int) $statut;
	}

	//CONSTRUCTEUR
	public function __construct(array $donnee){
		parent::__construct($donnee);
	}

	//METHODE
	public function __toString(){
		$str = $this->_id.' -  '.$this->_name.' - '.$this->_email.' - '.$this->_password.' - '.$this->_avatar.' - '.$this->_statut;
		return  $str;
	}

}