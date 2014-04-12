<?php
namespace Library;

class Route{
	private $_url,
		$_application,
		$_module,
		$_matches;

	public function __construct($url, $application,$module){
		$this->_url = $url;
		$this->_application = $application;
		$this->_module= $module;
	}

	public function match($url){

		//Recherche de la route
		if(preg_match('`^'.$this->_url.'$`', $url, $matches)){

			//Si correspondance, on split sur le / pour ne garder que les strings
			$this->_matches = explode("/",$matches[0]);
			return true;
			
		}else{
			return false;
		}
	}

	public function getMatches(){
		return $this->_matches;
	}

	public function getUrl(){
		return $this->_url;
	}

	public function getModule(){
		return $this->_module;
	}

	public function getApplication(){
		return $this->_application;
	}
}