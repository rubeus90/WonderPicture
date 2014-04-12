<?php
namespace Library;

abstract class Controleur extends ApplicationComponent{
	protected $_vars;

	public function __construct(Application $app,$vars){
		parent::__construct($app);
		$this->_vars = $vars;
	}

	//Obtenir l'odre d'affichage des images suivant les paramètres de l'utilisateur
	final protected function getOrderPicture(){
		$order = $this->getManagerof('Config')->get('order_picture');
		switch ($order){
			case 'date' :
				$order = 'date_import';
			break;

			case 'name' :
				$order ='name';
			break;

			case 'size' :
				$order = 'size';
			break;

			default :
				$order = 'name';
		}
		return $order;
	}

	//Obtnier l'ordre d'affichage des albums en fonction des paramètres de l'utilisateur
	final protected function getOrderAlbum(){
		$order = $this->getManagerof('Config')->get('order_album');

		switch ($order){
			case 'date' :
				$order = 'date_create';
			break;

			case 'name' :
				$order ='name';
			break;

			default :
				$order = 'date_create';
		}
		return $order;
	}

	//Instancie le Manager passé en paramètre
	final protected function getManagerof($manager){
		$path = '\\Library\Models\\'.$manager.'Manager';
		return $path::getInstance($this->_app->getPDO());
	}

	abstract function run();
}