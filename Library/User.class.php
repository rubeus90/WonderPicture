<?php
namespace Library;

session_start();

class User{

	public function get($attr){
		return isset($_SESSION[$attr]) ? $_SESSION[$attr] : NULL;
	}

	public function set($key, $attr){
		if(!is_string($key)){
			throw new \InvalidArgumentExeption('Merci de fournir un string à la méthode set de User');
		}
		$_SESSION[$key] = $attr;
	}

	public function Connexion($bool){
		if(!is_bool($bool)){
			throw new \InvalidArgumentExeption('Merci de fournir un boolean à la méthode Connexion de User');
		}
		$_SESSION['auth'] = $bool;
	}

	public function isConnected(){
		return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
	}
}