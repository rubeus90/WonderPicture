<?php
namespace Library;

class Controleur extends ApplicationComponent{

	public function __construct(Application $app){
		parent::__construct($app);
	}

	protected function getManagerof($manager){
		$path = '\\Library\Modeles\\'.$manager.'Manager';
		return new $path($this->_app->getPDO());
	}
}