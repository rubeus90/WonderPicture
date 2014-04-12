<?php
	// Permet de charger automatique les fichiers
	function autoload($class){
		$path =  '../'.str_replace('\\', '/', $class).'.php';
		require $path;
	}
	spl_autoload_register('autoload');