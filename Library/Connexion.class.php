<?php

namespace Library;

class Connexion{
	private $_host, 
		$_db,
		$_login, 
		$_pass, 
		$_pdo;

	public function __construct($host ,$db , $login, $pass){
		$this->_host = $host;
		$this->_db = $db;
		$this->_login = $login;
		$this->_pass = $pass;

		$this->dbConnect();
		if(!$this->createDB()){
			throw new \RuntimeException('Erreur de creation des tables');
		}
	}

	private function dbConnect(){
		try{
			$this->_pdo = new \PDO('mysql:host='.$this->_host.';dbname='.$this->_db, $this->_login, $this->_pass);
		} catch(Exception $e){
		    die('Erreur : '.$e->getMessage());
		}
	}

	private function createDB(){
		$query = "CREATE TABLE IF NOT EXISTS `album` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`titre` VARCHAR(45) NOT NULL,
				`description` VARCHAR(255) NULL,
				`acces` TINYINT(1) NOT NULL DEFAULT 1,
				`dateCreation` DATETIME NOT NULL,
				`urlMiniature` VARCHAR(100) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
	    if (!$this->_pdo->query($query)){
	    	return false;
	    }

		$query = "CREATE TABLE IF NOT EXISTS `photo` (
				`id` INT(11) NOT NULL AUTO_INCREMENT,
				`titre` varchar(45) NOT NULL,
				`description` varchar(255) NULL,
				`url` varchar(100) NOT NULL,
				`urlMiniature` varchar(100) NOT NULL,
				`extension` varchar(20) NOT NULL,
				`poids` INT NOT NULL,
				`largeur` SMALLINT NOT NULL,
				`hauteur` SMALLINT NOT NULL,
				`dateImport` DATETIME NOT NULL,
				`acces` TINYINT(1) NOT NULL DEFAULT 1,
				`albumId` INT NOT NULL,
				`note` TINYINT(4) NOT NULL DEFAULT 5,
				`nombreVotant` INT NOT NULL DEFAULT 0,
				PRIMARY KEY (`id`),
				CONSTRAINT fk_album_id 
					FOREIGN KEY (`albumId`)
					REFERENCES album(id) 
					ON DELETE CASCADE
					ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";

		if (!$this->_pdo->query($query)){
			return false;
		}

		$query = "CREATE TABLE IF NOT EXISTS `utilisateur` (
				`id` VARCHAR(50) NOT NULL,
				`mdp` VARCHAR(30) NOT NULL,
				`mail` VARCHAR(255) NULL,
				`estAdmin` TINYINT(1) NOT NULL DEFAULT 0,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
		if (!$this->_pdo->query($query)){
			return false;
		}

		$query = "CREATE TABLE IF NOT EXISTS `parametres` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`resolutionMiniature` SMALLINT NOT NULL DEFAULT 400,
				`qualiteMiniature` TINYINT(4) NOT NULL DEFAULT 75,
				`ordre_photo` VARCHAR(40) NOT NULL DEFAULT 'date',
				`ordre_album` VARCHAR(40) NOT NULL DEFAULT 'date',
				`nombreAffichage` TINYINT(4) NOT NULL DEFAULT 20,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
		if (!$this->_pdo->query($query)){
			return false;
		}

	    return true;
	}

	public function getPDO(){
		return $this->_pdo;
	}
}