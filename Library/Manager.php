<?php
namespace Library;

abstract class Manager{
	protected $_db;

	public function __construct($db){
		$this->_db =$db;
	}

	public function setDb(PDO $db){
		$this->_db =$db;
	}

	abstract public function add(Entity $entity);
	abstract public function delete($id);
	abstract public function update(Entity $entity);
}