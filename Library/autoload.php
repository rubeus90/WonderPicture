<?php
	// Permet de charger automatique les fichiers
	function autoload($class){
		echo '<pre>Autoload : ' . $class;
		$path =  '../'.str_replace('\\', '/', $class).'.class.php';
		echo "\n    =&gt; $path</pre>";
		require $path;
	}
	spl_autoload_register('autoload');