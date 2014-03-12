<?php
class Parametres extends Entities{
	private $id,
			$resolutionMiniature,
			$qualiteMiniature,
			$ordre_photo,
			$ordre_album,
			$nombreAffichage;

	public function getID(){ return $this->id};
	public function getResolutionMiniature(){ return $this->resolutionMiniature;}
	public function getQualiteMiniature(){ return $this->qualiteMiniature;}
	public function getOrdre_photo(){ return $this->ordre_photo;}
	public function getOrdre_album(){ return $this->ordre_album;}
	public function getNombreAffichage(){ return $this->nombreAffichage;}

	public function setId($id){
		if(is_numeric($id) and !empty($id) and $id>=0){
			$this->id = $id;
		}
	}
	public function setResolutionMiniature($cote){
		if(is_numeric($cote) and !empty($cote) and $cote>0){
			$this->resolutionMiniature = $cote;
		}
	}
	public function setQualiteMiniature($qualite){
		if(is_numeric($qualite) and !empty($qualite) and $qualite>0){
			$this->qualiteMiniature = $qualite;
		}
	}
	public function setOrdre_photo($ordre){
		if(is_string($ordre) and !empty($ordre)){
			$this->ordre_photo = $ordre;
		}
	}
	public function setOrdre_album($ordre){
		if(is_string($ordre) and !empty($ordre)){
			$this->ordre_album = $ordre;
		}
	}
	public function setNombreAffichage($nombre){
		if(is_numeric($nombre) and !empty($nombre)){
			$this->nombreAffichage = $nombre;
		}
	}
}
?>