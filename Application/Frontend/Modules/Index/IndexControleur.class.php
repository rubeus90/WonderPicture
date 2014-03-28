<?php

namespace Application\Frontend\Modules\Index;


class IndexControleur extends \Library\Controleur {
	
	public function run(){

		$managerPhoto = $this->getManagerof('Photo');
		$this->_app->getPage()->setvars('test','COUCOU');
		
	}
}