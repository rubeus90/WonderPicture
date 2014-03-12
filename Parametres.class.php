<?php
class Parametres extends Entities{
	private $resolutionMiniature,
			$qualiteMiniature,
			$ordrePhoto,
			$ordreAlbum,
			$nombreAffichage;

	public function getResolutionMiniature(){ return $resolutionMiniature;}
	public function getQualiteMiniature(){ return $qualiteMiniature;}
	public function getOrdrePhoto(){ return $ordrePhoto;}
	public function getOrdreAlbum(){ return $ordreAlbum;}
	public function getNombreAffichage(){ return $nomAffichage;}

	public function setResolutionMiniature($cote){
		if(is_numeric($cote) and !empty($cote) and $cote>0){
			$this->$resolutionMiniature = $cote;
		}
	}
	public function setQualiteMiniature($qualite){
		if(is_numeric($qualite) and !empty($qualite) and $qualite>0){
			$this->$qualiteMiniature = $qualite;
		}
	}
	public function setOrdrePhoto($ordre){
		if(is_string($ordre) and !empty($ordre)){
			$this->$ordrePhoto = $ordre;
		}
	}
	public function setOrdreAlbum($ordre){
		if(is_string($ordre) and !empty($ordre)){
			$this->$ordreAlbum = $ordre;
		}
	}
	public function setNombreAffichage($nombre){
		if(is_numeric($nombre) and !empty($nombre)){
			$this->$nombreAffichage = $nombre;
		}
	}
}
?>