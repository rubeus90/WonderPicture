<?php
namespace Library;

class Controleur extends ApplicationComponent{
	protected $matches;

	public function __construct(Application $app, $matches){
		parent::__construct($app);
		$this->matches = $matches;
	}

	protected function getManagerof($manager){
		$path = '\\Library\Modeles\\'.$manager.'Manager';
		return new $path($this->_app->getPDO());
	}
}