<?php
namespace Library;

class Router{
	private $_routes = array();

	//Initialise l'attribut $_routes avec des objects routes en parsant le XML route.xml
	private function parse(){
		$xml = new \DOMDocument;
      	$xml->load(__DIR__.'/../Application/Config/routes.xml');

      	$elements = $xml->getElementsByTagName('route');

      	foreach ($elements as $element){
      		$this->_routes[] = new Route($element->getAttribute('url'), $element->getAttribute('module'));
      	}
	}

	public function get($url){

		//On parse le XML des routes
		$this->parse();
		
		//On cherche une route dont l'URL correspondant à l'URL du client
		foreach($this->_routes as $route){
			if($route->match($url)){
				return $route;
			}		
		}

		//Si aucune route ne correspond, on lève une exeption
		throw new \RuntimeException('Aucune route ne correspond à l\'URL');
	}
}