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
		//if(!$this->createTables()){
		//	throw new \RuntimeException('Erreur de création des tables');
		//}
	}

	private function dbConnect(){

		try{
			$this->_pdo = new \PDO('mysql:host='.$this->_host.';dbname='.$this->_db, $this->_login, $this->_pass);
		} catch(Exception $e){
		    die('Erreur : '.$e->getMessage());
		}

	}

	//Créé les tables ... rien de compliquer si vous vous souvenez de vos cours de BDD
	private function createTables(){

		$query = "CREATE TABLE IF NOT EXISTS `settings` (
				`id` INT(11) NOT NULL AUTO_INCREMENT,
				`thumb_size` SMALLINT(6) NOT NULL DEFAULT '400',
				`thumb_quality` TINYINT(4) NOT NULL DEFAULT '75',
				`order_picture` VARCHAR(50) NOT NULL DEFAULT 'date',
				`order_album` VARCHAR(50) NOT NULL DEFAULT 'date',
				`nombre` TINYINT(4) NOT NULL DEFAULT '20',
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";

		if (!$this->_pdo->query($query))
			return false;

		$req = $this->_pdo->query('INSERT INTO settings(id,thumb_size,thumb_quality,order_picture,order_album,nombre) VALUES (NULL,400,75, "date","date",20)');

		$query = "CREATE TABLE IF NOT EXISTS `album` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`name` VARCHAR(50) NOT NULL,
				`description` VARCHAR(255),
				`public` TINYINT(1) NOT NULL DEFAULT '0',
				`date_create` DATETIME NOT NULL,
				`thumb` VARCHAR(40) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
	    if (!$this->_pdo->query($query))
	    	return false;

		$query = "CREATE TABLE IF NOT EXISTS `picture` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`name` VARCHAR(30) NOT NULL,
				`description` VARCHAR(255),
				`url` VARCHAR(40) NOT NULL,
				`urlmin` VARCHAR(40) NOT NULL,		
				`type` VARCHAR(20) NOT NULL,
				`size` INT NOT NULL,
				`width` SMALLINT NOT NULL,
				`height` SMALLINT NOT NULL,
				`date_import` DATETIME NOT NULL,
				`public` TINYINT(1) NOT NULL DEFAULT '0',
				`album_id` INT,
				PRIMARY KEY (`id`),
				CONSTRAINT fk_album_id 
					FOREIGN KEY (`album_id`)
					REFERENCES album(id) 
					ON DELETE SET NULL
					ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
		if (!$this->_pdo->query($query))
			return false;

	    $query = "CREATE TABLE IF NOT EXISTS `user` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`name` VARCHAR(30) NOT NULL,
				`email` VARCHAR(255) NOT NULL,
				`password` VARCHAR(255) NOT NULL,
				`avatar` VARCHAR(255) NOT NULL,
				`statut` TINYINT(2) NOT NULL  DEFAULT '0',
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
		if (!$this->_pdo->query($query))
			return false;


		$query = "CREATE TABLE IF NOT EXISTS `comment` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`picture_id` INT NOT NULL,
				`user_id` INT NOT NULL,
				`comment` TEXT NOT NULL,
				`date_publish` DATETIME NOT NULL,
				`date_update` DATETIME,
				PRIMARY KEY (`id`),
				CONSTRAINT fk_picture_id 
					FOREIGN KEY (`picture_id`)
					REFERENCES picture(id) 
					ON DELETE CASCADE
					ON UPDATE CASCADE,
				CONSTRAINT fk_user_id 
					FOREIGN KEY (`user_id`)
					REFERENCES user(id) 
					ON DELETE CASCADE
					ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
		if (!$this->_pdo->query($query))
			return false;

		$query = "CREATE TABLE IF NOT EXISTS `note` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`note` TINYINT NOT NULL,
				`user_id` INT NOT NULL,
				`picture_id` INT NOT NULL,
				PRIMARY KEY (`id`),
				CONSTRAINT fk2_picture_id 
					FOREIGN KEY (`picture_id`)
					REFERENCES picture(id) 
					ON DELETE CASCADE
					ON UPDATE CASCADE,
				CONSTRAINT fk2_user_id 
					FOREIGN KEY (`user_id`)
					REFERENCES user(id) 
					ON DELETE CASCADE
					ON UPDATE CASCADE
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";
		if (!$this->_pdo->query($query))
			return false;


		return true;

	}

	public function getPDO(){
		return $this->_pdo;
	}
}