<?php
namespace Library;

abstract class Application{
	protected $_pdo,
		$_page,
		$_name,
		$_HTTPResponse,
		$_user;

	public function __construct(){

		$this->_page = new Page($this);
		$connexion = new Connexion();	
		$this->_pdo = $connexion->getPDO();
		$this->_HTTPResponse = new HTTPResponse($this);
		$this->_user =  new User();
	}

	abstract public function run();

	public function getPDO(){
		return $this->_pdo;
	}

	public function getPage(){
		return $this->_page;
	}

	public function getName(){
		return $this->_name;
	}

	public function getHTTPResponse(){
		return $this->_HTTPResponse;
	}

	public function getUser(){
		return $this->_user;
	}
}