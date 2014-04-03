<?php
namespace Application\Backend\Modules\Settings;


class SettingsControleur extends \Library\Controleur {
	
	public function run(){
		if(isset($_POST['add'])){
			$this->add();
		}

		$this->_app->getPage()->setVars('title', '- Paramètre');
	}

	private function add(){
		$config = $this->getManagerof('Config');

		if(!empty($_POST['thumb_size'])){
			if(is_numeric($_POST['thumb_size'])){
				$config->set('thumb_size',$_POST['thumb_size']);
			}else{
				$txt = "Merci d'entrer un chiffre dans la case Thumb size";
				$this->_app->getPage()->setVars('txt', $txt);
			}
		}

		if(!empty($_POST['thumb_quality'])){
			if(is_numeric($_POST['thumb_quality'])){
				$config->set('thumb_quality',$_POST['thumb_quality']);
			}else{
				$txt = "Merci d'entrer un chiffre dans la case Thumb Quality";
				$this->_app->getPage()->setVars('txt', $txt);
			}
		}

		if(!empty($_POST['nombre'])){
			if(is_numeric($_POST['nombre'])){
				$config->set('nombre',$_POST['nombre']);
			}else{
				$txt = "Merci d'entrer un chiffre dans la case Nombre";
				$this->_app->getPage()->setVars('txt', $txt);
			}
		}
		
		if(!empty($_POST['nombre'])){	
			$config->set('mail_activation',$_POST['mail_activation']);
		}

		$config->set('order_album',$_POST['order_album']);
		$config->set('order_picture',$_POST['order_picture']);
		$config->set('mail',$_POST['mail']);
		$config->update();
	}
}