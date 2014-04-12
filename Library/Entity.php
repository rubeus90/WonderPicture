<?php
namespace Library;

abstract class Entity{
	public function __construct(array $donnee){
		if (!empty($donnee))
			$this->hydrate($donnee);
	}

	//Méthode d'hydratation
	private function hydrate(array $donnee){
		foreach($donnee as $key => $value){
			$method = 'set'.ucfirst($key);
			if(method_exists($this, $method))
				$this->$method($value);
		}
	}

	//Pour faciliter le debug
	abstract function __toString();

	//Créé une miniature avec les paramètres
	public function createThumb($width, $height,$type, $width_thumb, $quality, $dest, $arriv){		

		$thumb = imagecreatetruecolor($width_thumb, $width_thumb);

		//Pour cadrer l'image
		if($width < $height){
			$cote = $width;
			$x = 0;
			$y = $height/2 - $width/2; 
		} else{
			$cote = $height;
			$x = $width/2 - $height/2 ;
			$y = 0;
		}

		switch($type) {
			case 'jpg' :
			case 'JPG' :
	        case 'jpeg': $sourceImg = imagecreatefromjpeg($dest); break;
	        case 'png': $sourceImg = imagecreatefrompng($dest); break;
	        default: return false;
    	}

    	imagecopyresampled($thumb,$sourceImg,0,0,$x,$y,$width_thumb,$width_thumb,$cote,$cote);

    	imagejpeg($thumb,$arriv,$quality);
	}
}