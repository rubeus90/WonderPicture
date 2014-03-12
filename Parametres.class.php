<?php
class Parametres extends Entities{
	private $resolutionMiniature,
			$qualiteMiniature,
			$ordrePhoto,
			$ordreAlbum,
			$nombreAffichage;

	public getResolutionMiniature(){ return $resolutionMiniature;}
	public getQualiteMiniature(){ return $qualiteMiniature;}
	public getOrdrePhoto(){ return $ordrePhoto;}
	public getOrdreAlbum(){ return $ordreAlbum;}
	public getNombreAffichage(){ return $nomAffichage;}

	public setResolutionMiniature($cote){
		if(is_numeric($cote) and !empty($cote)){
			$this->$resolutionMiniature = $cote;
		}
	}
	public setQualiteMiniature($qualite){
		if(is_numeric($qualite) and !empty($qualite)){
			$this->$qualiteMiniature = $qualite;
		}
	}
	public setOrdrePhoto($ordre){
		if(is_string($ordre) and !empty($ordre)){
			$this->$ordrePhoto = $ordre;
		}
	}
	public setOrdreAlbum($ordre){
		if(is_string($ordre) and !empty($ordre)){
			$this->$ordreAlbum = $ordre;
		}
	}
	public setNombreAffichage($nombre){
		if(is_numeric($nombre) and !empty($nombre)){
			$this->$nombreAffichage = $nombre;
		}
	}
}