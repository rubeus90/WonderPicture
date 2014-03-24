<?php
namespace Library;

class Page extends ApplicationComponent{
	private $_view,
		$_vars =array();


	public function setVars($var, $value){
		if( empty($var)  && empty($value) && is_string($var)){
			throw new \RuntimeException('Bug de valeur');
		}
		$this->_vars[$var] = $value;
	}

	public function setView($view){
		if (is_string($view) && !empty($view) && file_exists($view)){
			$this->_view = $view;
		}
	}

	public function getPage(){
		if (file_exists($this->_view)){
			
			extract($this->_vars);

			ob_start();
			require $this->_view;
			return  ob_get_clean();
		}
		
		throw new \RuntimeException('La vue spécifiée n\'existe pas');
	}
}