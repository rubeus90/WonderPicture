<?php
	require '../Library/Connexion.php';

	$connexion = new \Library\Connexion();
	$pdo = $connexion->getPDO();

	function createDatabase(){
		global $pdo;
		$query = "CREATE DATABASE IF NOT EXISTS wonderpicture9 CHARACTER SET 'utf8';";

		return ($pdo->query($query) === false) ? false : true;
	}

	function createSettings(){
		global $pdo;
		$query = "CREATE TABLE IF NOT EXISTS `settings` (
				`id` INT(11) NOT NULL AUTO_INCREMENT,
				`thumb_size` SMALLINT(6) NOT NULL DEFAULT '400',
				`thumb_quality` TINYINT(4) NOT NULL DEFAULT '75',
				`order_picture` VARCHAR(50) NOT NULL DEFAULT 'date',
				`order_album` VARCHAR(50) NOT NULL DEFAULT 'date',
				`nombre` TINYINT(4) NOT NULL DEFAULT '20',
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";

		return ($pdo->query($query) === false) ? false : true;
	}
		

	function insertSettings(){
		global $pdo;
		return (($pdo->query('INSERT INTO settings(id,thumb_size,thumb_quality,order_picture,order_album,nombre) VALUES (NULL,400,75, "date","date",20)')) === false) ? false : true;
	}

	function createAlbum(){
		global $pdo;
		$query = "CREATE TABLE IF NOT EXISTS `album` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`name` VARCHAR(50) NOT NULL,
				`description` VARCHAR(255),
				`public` TINYINT(1) NOT NULL DEFAULT '0',
				`date_create` DATETIME NOT NULL,
				`thumb` VARCHAR(40) NOT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";

		if($pdo->query($query) == false){
			echo "connard c'est false";
			$req = true;
		}else{
			echo "visiblement c'est égal a autre chose";
			$req = false;
		}
	    
	    return ($req) ? false : true;
	}

	function createPicture(){
		global $pdo;
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

			return ($pdo->query($query) == false) ? false : true;
	}

	function createUser(){
		global $pdo;
		$query = "CREATE TABLE IF NOT EXISTS `user` (
				`id` INT NOT NULL AUTO_INCREMENT,
				`name` VARCHAR(30) NOT NULL,
				`email` VARCHAR(255) NOT NULL,
				`password` VARCHAR(255) NOT NULL,
				`avatar` VARCHAR(255) NOT NULL,
				`statut` TINYINT(2) NOT NULL  DEFAULT '0',
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8; ";

		return ($pdo->query($query) == false) ? false : true;
	}

	function createComment(){
		global $pdo;
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

		return ($pdo->query($query) == false) ? false : true;
	}

	function createNote(){
		global $pdo;
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

		return ($pdo->query($query) == false) ? false : true;
	}	
?>

<!DOCTYPE html>
<html>
 	<head>
 		<meta charset="utf-8">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400' rel='stylesheet' type='text/css'>
		<title>WonderPicture - Initialisation</title>
	</head>
	<body>
		<header>
			<h1>WonderPicture</h1>
		</header>

		<section>
			<?php if(!createDatabase()){
				echo "fuck 1";
			}else if(!createSettings()){
				echo "fuck 2";
			}else if(!insertSettings()){
				echo "fuck 3";
			}else if(!createAlbum()){
				echo "fuck 4";
			}else if(!createPicture()){
				echo "fuck 5";
			}else if(!createUser()){
				echo "fuck 6";
			}else if(!createComment()){
				echo "fuck 7";
			}else if(!createNote()){
				echo "fuck 8";
			}else{
				echo "victoire ?";
			}?>
		</section>
	</body>
</html>