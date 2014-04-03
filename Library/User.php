<?php
namespace Library;

session_start();

class User{

	public function Connexion(Entities\User $user){
		$_SESSION['user'] = $user;
		$_SESSION['auth'] = true;
	}

	public function deconnexion(){
		session_destroy();
	}


	public function get($attr){
		return isset($_SESSION[$attr]) ? $_SESSION[$attr] : NULL;
	}

	public function setAdmin($bool){
		if(!is_bool($bool)){
			throw new \InvalidArgumentExeption('Merci de fournir un boolean à la méthode Connexion de User');
		}
		$_SESSION['admin'] = $bool;
	}

	public function isConnected(){
		return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
	}

	public function isAdmin(){
		return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
	}
}