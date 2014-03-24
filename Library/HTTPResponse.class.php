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

	public function redirect($location){
		header('Location: '.$location);
	}
}