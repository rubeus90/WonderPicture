<?php
namespace Library;

class Page extends ApplicationComponent{
	private $_view,
		$_vars =array();


	//Ajouter des paramètres à la vue
	public function setVars($var, $value){
		if( empty($var)  && empty($value) && is_string($var)){
			throw new \RuntimeException('Bug de valeur');
		}
		$this->_vars[$var] = $value;
	}

	//Définir la vue du controleur
	public function setView($view){
		if (is_string($view) && !empty($view) && file_exists($view)){
			$this->_view = $view;
		}
	}

	//Construction de la page
	public function getPage(){
		if (file_exists($this->_view)){
			
			extract($this->_vars);

			ob_start();
			require $this->_view;
			$content = ob_get_clean();

			ob_start();
			require __DIR__.'/../Application/'.$this->_app->getName().'/Templates/nav.php';
			$nav = ob_get_clean();

			ob_start();
			require __DIR__.'/../Application/'.$this->_app->getName().'/Templates/layout.php';
			return ob_get_clean();
		}
		
		throw new \RuntimeException('La vue spécifiée n\'existe pas');
	}
}