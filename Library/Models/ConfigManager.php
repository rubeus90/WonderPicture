<?php
namespace Library\Models;

use \Library\Entity;

class ConfigManager{
	private static $instance;
	private $_vars = array(), // Hashmap
			$_db;

	private function __construct($db){
		$this->_db =$db;
		$this->hydrate();
	}

	public static function getInstance($pdo){
		if (!isset(self::$instance)){
			self::$instance = new self($pdo);
		}
		return self::$instance;
	}

	private function hydrate(){
		$req = $this->_db->query('SELECT * FROM settings');
    	$donnee = $req->fetch(\PDO::FETCH_ASSOC);
    	
    	foreach($donnee as $key => $value){
			$this->_vars[$key] = $value;
		}
	}

	public function update(){
		$thumb_size = $this->get('thumb_size');
		$thumb_quality = $this->get('thumb_quality');
		$order_picture = $this->get('order_picture');
		$order_album = $this->get('order_album');
		$nombre = $this->get('nombre');

		$req = $this->_db->prepare('UPDATE settings SET thumb_size = :thumb_size, thumb_quality = :thumb_quality, order_picture = :order_picture, order_album = :order_album, nombre = :nombre WHERE id = 1');
		$req->bindParam(':thumb_size',$thumb_size,\PDO::PARAM_INT);
		$req->bindParam(':thumb_quality',$thumb_quality,\PDO::PARAM_INT);
		$req->bindParam(':order_picture',$order_picture,\PDO::PARAM_STR);
		$req->bindParam(':order_album',$order_album,\PDO::PARAM_STR);
		$req->bindParam(':nombre',$nombre,\PDO::PARAM_INT);
		$req->execute();
	}

	 public function set($key, $var){
	 	if (is_string($key) && !empty($key) && !empty($var)){
	 		$this->_vars[$key] = $var;
	 	}
	 }

	//Retourne la valeur de la clé demandé
	public function get($var){
		return (isset($this->_vars[$var])) ? $this->_vars[$var] : NULL;
	}

}