<?php
namespace Library;

class HTTPResponse{
	private $_app;

	public function __construct(Application $app){
		$this->_app = $app;
	}

	public function send($page){
		exit($page);
	}

	//Renvoi la page d'erreur
	public function error(){
		ob_start();
		require __DIR__.'/../Application/Config/error.html';
		exit(ob_get_clean());
	}

	//Erreur 404
	public function redirect404(){
		header("HTTP/1.0 404 Not Found");
		exit();
	}

	//Redirige vers le paramètre
	public function redirect($location){
		header('Location: '.$location);
	}
}