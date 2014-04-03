<?php
namespace Library\Entities;

class Album extends \Library\Entity{
	private $_id,
	$_name,
	$_description,
	$_date_create,
	$_public,
	$_thumb;


	// GETTER 
	public function getId(){
		return $this->_id;
	}

	public function getName(){
		return $this->_name;
	}

	public function getDescription(){
		return $this->_description;
	}


	public function getDate_create(){
		return $this->_date_create;
	}

	public function isPublic(){
		return ($this->_public == 1) ? true : false;
	}

	public function getThumb(){
		return $this->_thumb;
	}


	//SETTER
	public function setId($id){
		$this->_id = (int) $id;
	}

	public function setName($name){
		if (is_string($name) && !empty($name))
			$this->_name = $name;
	}

	public function setDescription($description){
		if(is_string($description) && !empty($description))
			$this->_description = $description; 
	}

	public function setDate_create($date){
		if(is_string($date) && !empty($date))
			$this->_date_create = $date; 
	}

	public function setPublic($public){
		$this->_public = (int) $public;
	}

	public function setThumb($thumb){
		if(is_string($thumb) && !empty($thumb))
			$this->_thumb = $thumb;
	}

	//CONSTRUCTEUR
	public function __construct(array $donnee){
		parent::__construct($donnee);
	}

	//METHODE
	public function __toString(){
		$str = 'Type = Album'."\r\n";
		$str .= 'Nom : '.$this->getName()."\r\n";
		$str .= 'Description : '.$this->getDescription()."\r\n";
		$str .= 'Date d\'ajout : '.$this->getDate_create()."\r\n";
		$str .= 'Visibilite : '.$this->isPublic();
		return  $str;
	}

}