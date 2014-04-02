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

	public function error(){
		ob_start();
		require __DIR__.'/../Application/Config/error.html';
		exit(ob_get_clean());
	}

	public function redirect404(){
		header("HTTP/1.0 404 Not Found");
		exit();
	}

	public function redirect($location){
		header('Location: '.$location);
	}
}