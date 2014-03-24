<?php

namespace Library;

abstract class Entities{
	public function __construct(array $donnee){
		if (!empty($donnee))
			$this->hydrate($donnee);
	}

	private function hydrate(array $donnee){
		foreach($donnee as $key => $param){
			$method = 'set'.ucfirst($key);
			if(method_exists($this, $method))
				$this->$method($param);
		}
	}
}