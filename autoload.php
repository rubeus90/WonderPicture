<?php
	// Permet de charger automatique les fichiers
	function autoload($class){
		require  $class.'.class.php';	
	}
	spl_autoload_register('autoload');