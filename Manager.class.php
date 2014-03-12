<?php

abstract class Manager{
	protected $_db;

	public function __construct($db){
		$this->_db =$db;
	}

	public function setDb(PDO $db){
		$this->_db =$db;
	}
}