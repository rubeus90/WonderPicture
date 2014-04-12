<?php
namespace Library;

class Connexion{
	private $_host, 
		$_db,
		$_login, 
		$_pass, 
		$_pdo;

	public function __construct(){
		$this->_host = 'localhost';
		$this->_db = 'wonderpicture';
		$this->_login = 'root';
		$this->_pass = '';

		$this->dbConnect();
	}

	//Permet de se connecter à la base de donnée
	private function dbConnect(){

		try{
			$this->_pdo = new \PDO('mysql:host='.$this->_host.';dbname='.$this->_db, $this->_login, $this->_pass);
		} catch(Exception $e){
		    die('Erreur : '.$e->getMessage());
		}

	}

	public function getPDO(){
		return $this->_pdo;
	}
}