<?php
namespace Library\Entities;

class Picture extends \Library\Entity{
	private $_id,
	$_name,
	$_description,
	$_url,
	$_urlmin,
	$_type,
	$_size,
	$_width,
	$_height,
	$_date_import,
	$_public,
	$_album_id;


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

	public function getUrl(){
		return $this->_url;
	}

	public function getUrlmin(){
		return $this->_urlmin;
	}

	public function getType(){
		return $this->_type;
	}

	public function getSize(){
		return $this->_size;
	}

	public function getWidth(){
		return $this->_width;
	}

	public function getHeight(){
		return $this->_height;
	}

	public function getDate_import(){
		return $this->_date_import;
	}

	public function isPublic(){
		return ($this->_public == 1) ? true : false;
	}

	public function getAlbum_id(){
		return $this->_album_id;
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

	public function setUrl($url){
		if(is_string($url) && !empty($url))
			$this->_url = $url;
	}

	public function setUrlmin($url){
		if(is_string($url) && !empty($url))
			$this->_urlmin = $url;
	}

	public function setType($type){
		if(is_string($type) && !empty($type))
			$this->_type = $type;
	}

	public function setSize($size){
		$this->_size = (int) $size;
	}

	public function setWidth($width){
		$this->_width = (int) $width;
	}

	public function setHeight($height){
		$this->_height = (int) $height;
	}

	public function setDate_import($date){
		if(is_string($date) && !empty($date))
			$this->_date_import = $date;
	}

	public function setPublic($public){
		$this->_public = (int) $public;
	}

	public function setAlbum_id($id){
		$this->_album_id = (int) $id;
	}

	//CONSTRUCTEUR
	public function __construct(array $donnee){
		parent::__construct($donnee);
	}

	//METHODE
	public function __toString(){
		$str = 'Type = Picture'."\r\n";
		$str .= 'Nom : '.$this->getName()."\r\n";
		$str .= 'Description : '.$this->getDescription()."\r\n";
		$str .= 'Date d\'ajout : '.$this->getDate_import()."\r\n";
		$str .= 'Taille : '.$this->getWidth().'x'.$this->getHeight()."\r\n";
		$str .= 'Poid : '.$this->getSize()."\r\n";
		$str .= 'Visibilite : '.$this->isPublic();
		return  $str;
	}
}