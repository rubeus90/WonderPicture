<?php
namespace Library\Entities;

class Comment extends \Library\Entity{
	private $_id,
	$_picture_id,
	$_user_id,
	$_comment,
	$_date_publish,
	$_date_update;


	// GETTER 
	public function getId(){
		return $this->_id;
	}

	public function getPicture_id(){
		return $this->_picture_id;
	}

	public function getUser_id(){
		return $this->_user_id;
	}

	public function getComment(){
		return $this->_comment;
	}

	public function getDate_publish(){
		return $this->_date_publish;
	}

	public function getDate_update(){
		return $this->_date_update;
	}

	//SETTER
	public function setId($id){
		if (is_numeric($id) && !empty($id))
			$this->_id = (int) $id;
	}

	public function setPicture_id($id){
		if (is_numeric($id) && !empty($id))
			$this->_picture_id = (int) $id;
	}

	public function setUser_id($id){
		if(is_numeric($id) && !empty($id))
			$this->_user_id = (int) $id; 
	}

	public function setComment($text){
		if(!empty($text))
			$this->_comment= $text; 
	}

	public function setDate_publish($date){
		if(!empty($date))
			$this->_date_publish = $date; 
	}

	public function setDate_update($date){
		if(!empty($date))
			$this->_date_update = $date; 
	}

	//CONSTRUCTEUR
	public function __construct(array $donnee){
		parent::__construct($donnee);
	}

	//METHODE
	public function __toString(){
		$str = $this->_id.' - '.$this->_picture_id.' - '.$this->_user_id.' - '.$this->_comment.' - '.$this->_date_publish;
		return  $str;
	}

}