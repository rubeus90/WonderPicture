<?php
namespace Library;

abstract class Manager implements \Library\Singleton{
	protected $_db;

	//Constructeur privé
	private function __construct($db){
		$this->_db =$db;
	}

	public function setDb(PDO $db){
		$this->_db =$db;
	}

	//Méthode getInstance -> Singleton
	public static function getInstance($pdo){
		if (!isset(static::$instance)){
			static::$instance = new static($pdo);
		}
		return static::$instance;
	}

	

	abstract public function add(Entity $entity);
	abstract public function delete($id);
	abstract public function update(Entity $entity);
}