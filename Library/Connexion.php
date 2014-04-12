<?php
namespace Library;

class Connexion{
	private $_host, 
		$_db,
		$_login, 
		$_pass, 
		$_pdo;

	public function __construct(){
		$this->parse();
		$this->dbConnect();
	}

	//Parse le fichier de config PDO
	private function parse(){
		$vars = array();
		$xml = new \DOMDocument;
		$xml->load(__DIR__.'/../Application/Config/pdo.xml');

		$elements = $xml->getElementsByTagName('define');

		foreach ($elements as $element){
			$vars[$element->getAttribute('var')] = $element->getAttribute('value');
		}

		$this->_host = $vars['host'];
		$this->_db = $vars['db'];
		$this->_login = $vars['login'];
		$this->_pass = $vars['pass'];
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