<?php

namespace Application\Frontend\Modules\Index;


class IndexControleur extends \Library\Controleur {
	
	public function run(){
		//On récupère le nombre de photo a afficher sur la page d'accueil
		$limit = $this->getManagerof('Config')->get('nombre');

		//On instancie le manager des Photos et on récupère les N photos demandé en prenant en compte le statut du visiteur
		$pictures =  ($this->_app->getUser()->isConnected()) ? $this->getManagerof('Picture')->getLast($limit,true) :  $this->getManagerof('Picture')->getLast($limit,false);
		

		$this->_app->getPage()->setVars('pictures', $pictures);
		$this->_app->getPage()->setVars('title', '');
	}
}